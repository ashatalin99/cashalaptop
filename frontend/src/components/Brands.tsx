import { Input } from "./ui/input";
import type { BrandProps } from "@/types/Brands";

const Brands = ({ terms }: BrandProps) => {
  return (
    <section className="flex flex-col items-center justify-center bg-[#F1F1F1] border border-t-[#ddd] border-b-[#ddd] py-26">
      <h2 className="text-[2.25rem] font-semibold mb-3 leading-[1.4] text-[#222]">Select yor model to sell</h2>
      <div className="mx-auto px-4 w-[800px] mb-6">
            <Input 
                className="border border-[#bbb] bg-white text-[1rem] mx-auto w-full px-4 py-3 rounded-sm focus:outline-none focus:border-none focus-ring-1 focus:ring-[#1e90fe] placeholder:text-[rgba(0,0,0,.75)]"
                placeholder="Search for your laptop model or brand"
                type="text"
                aria-label="Search for your laptop model or brand"
                autoComplete="off"
                spellCheck="false"
                autoFocus
                role="searchbox"
            />
        </div>
        {
          <ul className="max-w-7xl grid grid-cols-4 grid-rows-3">
              {terms.map((brand) => (
                  <li key={brand.id} className="flex items-center flex-col justify-center text-center border border-gray-300 bg-white m-4 hover:shadow-[0_0_15px_rgba(0,0,0,0.5)]">
                      <a href={`/sell/${brand.slug}`}>
                        <div
                          className="w-[250px] h-[250px] flex items-center justify-center p-6 "
                          dangerouslySetInnerHTML={{ __html: brand.description ?? "" }}
                        ></div>
                        <div className="my-4">{brand.name}</div>
                      </a>
                  </li>
              ))}
          </ul>
        }
    </section>
  );
};

export { Brands };
