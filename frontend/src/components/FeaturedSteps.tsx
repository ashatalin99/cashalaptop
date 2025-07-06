"use client";
import type { StepsSection } from "@/types/StepsSection";

const FeaturedSteps = ({ title, items }: StepsSection) => {
  if (!title || !items || items.length === 0) {
    return null; 
  }
  return (
    <section className="py-20 ">
      <div className="mx-auto px-4 lg:w-7xl">
        <div className="grid md:grid-cols-3 gap-4">
          {
            title && (
              <h3 className="col-span-3 text-2xl md:text-3xl lg:text-4xl font-light text-center mb-8 text-[#555]"
                dangerouslySetInnerHTML={{ __html: title }}>
              </h3>
            ) 
          }
          {
            items.length !== 0 ? (
              items.map((items, index) => (
                <div className="flex flex-col items-center p-6" key={index}>
                  {items?.icon && items.icon?.sourceUrl && (
                    <img 
                      src={items.icon.sourceUrl} 
                      alt={items.title} 
                      className="mb-8"
                    />
                  )}
                  <h3 className="text-[1.35rem] text-[#333] font-semibold mb-8">{items.title}</h3>
                  <p className="max-w-[25rem] text-center">{items.subtitle}</p>
                </div>
              ))
            ) : null
          }
        </div>
      </div>
    </section>
  );
};

export { FeaturedSteps }
