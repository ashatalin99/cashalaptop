"use client";
import clsx from "clsx";
export interface HeroProps {
  title: string;
  subtitle?: string;
  image: { src: string; alt: string };
  cta?: { url: string; label: string; target?: "_blank" | "_self" };
}

const Hero = ({title, subtitle, image, cta}: HeroProps) => {
 
  return (
    <section style={{ background: `url(${image.src}) no-repeat center bottom/cover` }} className="relative py-40 after:content-[''] after:absolute after:inset-0 after:bg-[#222]/90">
      <div className="container mx-auto px-4 relative z-10">
        <h1
          className="text-4xl sm:text-4xl md:text-5xl lg:text-[3.25rem] font-bold text-white text-center leading-tight uppercase"
          dangerouslySetInnerHTML={{ __html: title }}
        ></h1>
        {subtitle && (
          <p className="text-[1.5rem] text-center text-[#d4d4d4] py-4">
            {subtitle}
          </p>
        )}
        <div className="text-center">
          {cta && (
            <a
              href={cta.url}
              target={cta.target}
              className="mt-8 mx-auto inline-flex items-center bg-[#ED6C0B] text-white font-semibold py-3 px-6 rounded-sm hover:bg-[#C95C09] transition-colors"
            >
              {cta.label}
            </a>
          )}
        </div>
      </div>
    </section>
  );
}

export { Hero }