import { Header } from "@/components/Header";
import { FullHero } from "@/components/FullHero";
import { HowItWorks } from "@/components/HowItWorks";
import { StartSelling } from "@/components/StartSelling";
import { Testimonials } from "@/components/Testimonials";
import { FeaturedBlog } from "@/components/FeaturedBlog";
import { Footer } from "@/components/Footer";

export default function Home() {
  return (
    
    <div className="min-h-screen bg-white">
      <Header />
      <FullHero />
      <HowItWorks />
      <StartSelling />
      <Testimonials />
      <FeaturedBlog />
      <Footer />
    </div>
  );
}
