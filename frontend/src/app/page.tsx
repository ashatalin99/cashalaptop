import { sdk } from '@/lib/sdk';
import Image from 'next/image';
import { Metadata } from 'next';

import { Header } from "@/components/Header";
import { Hero } from "@/components/Hero";
import { HowItWorks } from "@/components/HowItWorks";
import { StartSelling } from "@/components/StartSelling";
import { Testimonials } from "@/components/Testimonials";
import { FeaturedBlog } from "@/components/FeaturedBlog";
import { Footer } from "@/components/Footer";

export const revalidate = 60;        // ISR: rebuild at most once a minute



export default async function Home() {
  const { pageBy, posts } = await sdk.HomePage();
  if (!pageBy) return <h1>Home page not found</h1>;
  
  const hero = pageBy.heroSection;
  if (!hero) return <h1>Hero section not found</h1>;

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

  //console.log(pageBy);
  return (
    
    <div className="min-h-screen bg-white">
      <Header />
      <Hero {...heroProps} />
      {/* <Header />
      <FullHero />
      <HowItWorks />
      <StartSelling />
      <Testimonials />
      <FeaturedBlog />
      <Footer /> */}
    </div>
  );
}



// export async function generateMetadata(): Promise<Metadata> {
//   const { pageBy } = await sdk.HomePage();
//   return {
//     title: pageBy?.seo?.title ?? pageBy?.title,
//     description: pageBy?.seo?.metaDesc ?? undefined,
//   };
// }