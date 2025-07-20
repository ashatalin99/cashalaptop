
import React from 'react';
import { sdk } from '@/lib/sdk';
import { Metadata } from 'next';
import { notFound } from 'next/navigation';
import { TaxonomyEnum } from '@/lib/gql-sdk';
import { BrandProps } from '@/types/Brands';
import { Header } from '@/components/Header';
import { Footer } from '@/components/Footer';
import { Hero } from '@/components/Hero';
import { Brands } from '@/components/Brands';
import { Faqs } from '@/components/Faqs';
import { FaqProps } from '@/types/Faqs';


export const revalidate = 60;        // ISR: rebuild at most once a minute

interface Props {
  params: { postType: string; };
}

export default async function PostTypePage({ params }: Props) {
    const { menu } = await sdk.GetHeaderNav();
    const { page } = await sdk.GetCustomPostType({
      pageId: `/${params.postType}/`,
      idType: 'URI',
    });
    
    if (!page) {
      notFound();
    } 


    const { contentTypes } = await sdk.GetCustomPostTypes({ first: 100, after: null });
    if (!contentTypes?.nodes || contentTypes.nodes.length === 0) {
      notFound();
    }
    const customPostType = contentTypes?.nodes.find((c) => (c.graphqlSingleName?.toLowerCase().replace(/_/g, '-') ?? "") === params.postType.toLowerCase())
  
    if (!customPostType) {
      notFound();
    }

    const postTypeSlug  = params.postType;   
    const { terms } = await sdk.GetAllTaxonomyTerms({
    taxonomy: postTypeSlug.toUpperCase().replace(/-/g, '') + 'BRAND' as TaxonomyEnum,
    first: 100,
    after: null,
    });
 
    const headerNav = menu?.menuItems?.nodes;
    if (!headerNav) return <h1>HeaderNav not found</h1>;
    if (!terms?.nodes) notFound();
    if (!page?.heroSection) return notFound();

    const headerProps = {
      navItems: headerNav.map((item) => ({
        id: item.id,
        label: item.label ?? "",
        url: item.url ?? "#",
        parentId: item.parentId ?? "", 
        target: (item.target as "_blank" | "_self") ?? "_self",
        childItems: {
          nodes: (item.childItems?.nodes ?? []).map((child) => ({
            id: child.id,
            label: child.label ?? "",
            url: child.url ?? "#",
            parentId: child.parentId ?? "",
            target: (child.target as "_blank" | "_self") ?? "_self",
            childItems: { nodes: [] },
          })),
        },
      })),
    } satisfies Parameters<typeof Header>[0];

    const heroProps = {
    title: page?.heroSection.title ?? "",
    subtitle: page?.heroSection.subtitle ?? undefined,
    image: {
      src: page?.heroSection.featuredImage?.node?.sourceUrl ?? "/placeholder.jpg",
      alt:
        page?.heroSection.featuredImage?.node?.altText ??
        page?.heroSection.title ??
        "Homepage feature image",
    },
    cta:
      page?.heroSection.button?.url
        ? {
            url: page?.heroSection.button.url,
            label: page?.heroSection.button.title ?? "Learn more",
            target: page?.heroSection.button.target as "_blank" | "_self",
          }
        : undefined,
  } satisfies Parameters<typeof Hero>[0];


    const brandsProps = {
        terms: terms.nodes.map((term) => ({
        id: term.id,
        name: term.name ?? "",
        slug: `${postTypeSlug}/${term.slug}`,
        description: term.description ?? ""
        })),  
    } satisfies BrandProps;

    const faqProps = {
        faqs: page?.faqSection?.faqs?.nodes
            ? page.faqSection.faqs.nodes
                .map((faq) => ({
                    id: faq.id,
                    title: faq.title ?? "",
                    content: faq.content ?? "",
                    
                }))
            : [],
    } satisfies FaqProps;

    return (
        <div className="min-h-screen bg-white">
            <Header {...headerProps}/>
            <Hero {...heroProps} />
            <Brands {... brandsProps} />
            <Faqs {... faqProps} />
            <Footer />
        </div>
    );
}

/** 2. (optional) Generate static params for SSG / ISR */
// export async function generateStaticParams() {
//   const { categories } = await sdk.GetAllCategorySlugs(); // a light query
//   return categories?.nodes.map((c) => ({ category: c.slug }));
// }