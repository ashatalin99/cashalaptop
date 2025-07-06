
import { sdk } from '@/lib/sdk';
import type { StepsSection } from "@/types/StepsSection";
import Image from 'next/image';
import { Metadata } from 'next';

import { Header } from "@/components/Header";
import { Hero } from "@/components/Hero";
import { FeaturedSteps } from "@/components/FeaturedSteps";
import { StartSelling } from "@/components/StartSelling";
import { Testimonials } from "@/components/Testimonials";
import { FeaturedBlog } from "@/components/FeaturedBlog";
import { Footer } from "@/components/Footer";

export const revalidate = 60;        // ISR: rebuild at most once a minute

export default async function Home() {
  const { menu } = await sdk.HeaderNav();
  const { pageBy, posts } = await sdk.HomePage();
  

  if (!menu) return <h1>Header menu not found</h1>;
  if (!pageBy) return <h1>Home page not found</h1>;
  
  const headerNav = menu.menuItems?.nodes;
  if (!headerNav) return <h1>HeaderNav not found</h1>;

  const hero = pageBy.heroSection;
  if (!hero) return <h1>Hero section not found</h1>;

  const stepsSection = pageBy.featuredSteps;
  if (!stepsSection) return <h1>Featured Steps section not found</h1>;
  console.log(stepsSection);

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
    title: hero.title ?? "",
    subtitle: hero.subtitle ?? undefined,
    image: {
      src: hero.featuredImage?.node?.sourceUrl ?? "/placeholder.jpg",
      alt:
        hero.featuredImage?.node?.altText ??
        hero.title ??
        "Homepage feature image",
    },
    cta:
      hero.button?.url
        ? {
            url: hero.button.url,
            label: hero.button.title ?? "Learn more",
            target: hero.button.target as "_blank" | "_self",
          }
        : undefined,
  } satisfies Parameters<typeof Hero>[0];

  // Map stepsSection to match StepsSection type
  const stepsSectionProps: StepsSection = {
    title: stepsSection.sectionTitle ?? "",
    items: (stepsSection.steps ?? []).map((step) => ({
      title: step?.title ?? "",
      subtitle: step?.subtitle ?? "",
      icon: step?.icon?.node?.sourceUrl
        ? { sourceUrl: step.icon.node.sourceUrl }
        : undefined,
    })),
  };

  return (
    <div className="min-h-screen bg-white">
      <Header {...headerProps}/>
      <Hero {...heroProps} />
      <FeaturedSteps {...stepsSectionProps} />
    </div>
  )
}