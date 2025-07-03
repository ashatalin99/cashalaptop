import { Header } from "@/components/Header";
import { FullHero } from "@/components/FullHero";
import { HowItWorks } from "@/components/HowItWorks";
import { StartSelling } from "@/components/StartSelling";

export default function Home() {
  return (
    
    <div className="min-h-screen bg-white">
      <Header />
      <FullHero />
      <HowItWorks />
      <StartSelling />
    </div>
  );
}
