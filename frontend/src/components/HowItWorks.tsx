"use client";
import { Search, Package, CreditCard } from "lucide-react";

const HowItWorks = () => {
  const steps = [
    {
      icon: Search,
      title: "Get Your Quote",
      description: "Enter your laptop details and get an instant quote in seconds."
    },
    {
      icon: Package,
      title: "Ship It Free",
      description: "Print our prepaid shipping label and send your laptop to us safely."
    },
    {
      icon: CreditCard,
      title: "Get Paid Fast",
      description: "Receive payment within 24 hours via PayPal, check, or bank transfer."
    }
  ];

  return (
    <section className="py-20 ">
      <div className="mx-auto px-4 lg:w-7xl">
        <div className="grid md:grid-cols-3 gap-4">
          <h3 className="col-span-3 text-2xl md:text-3xl lg:text-4xl font-light text-center mb-8 text-[#555]">
            Get <span className="text-[#1e90fe] font-bold">Cash</span> in Three Simple Steps
          </h3>
          <div className="flex flex-col items-center p-6">
              <svg 
                className="stroke-[#f1852a] h-[80px] w-[80px] mb-8"
                fill="none"
                xmlns="http://www.w3.org/2000/svg" 
                viewBox="0 0 32.71 32.71">
                <rect x=".35" y=".35" width="32" height="32" rx="2.37" ry="2.37"></rect>
                <path d="M6.15 9.84h6.33M9.31 13.01V6.67M7.07 21.56l4.48 4.48M7.07 26.04l4.48-4.48M20.23 9.84h6.33M20.23 25.42h6.33M20.23 22.18h6.33"></path>
              </svg>
              <h3 className="text-[1.35rem] text-[#333] font-semibold mb-8">1. Get an Instant Quote</h3>
              <p className="max-w-[25rem] text-center">Find your used electronics and get an instant<br /> quote based on the condition.</p>
            </div>

            <div className="flex flex-col items-center p-6">
              <svg 
                className="stroke-[#f1852a] h-[80px] w-[114px] mb-8 stroke-[.71px]"
                fill="none"
                xmlns="http://www.w3.org/2000/svg" 
                viewBox="0 0 32.71 22.87">
                <path d="M27.54 19.76h3.55a1.26 1.26 0 001.26-1.26V13a1.64 1.64 0 00-1.64-1.64H18.08v-11H1.62A1.26 1.26 0 00.35 1.62V18.5a1.26 1.26 0 001.26 1.26h3.27" transform="translate(0)"></path>
                <path d="M10.41 19.76h11.6M18.08 3.42h6.06l5.62 7.93"></path>
                <circle cx="7.64" cy="19.76" r="2.76"></circle>
                <circle cx="24.78" cy="19.76" r="2.76"></circle>
              </svg>
              <h3 className="text-[1.35rem] text-[#333] font-semibold mb-8">2. Ship For Free</h3>
              <p className="max-w-[25rem] text-center">We provide you with a free, trackable pre-paid shipping label for sending us your item(s).</p>
            </div>

            <div className="flex flex-col items-center p-6">
              <svg 
                className="stroke-[#f1852a] h-[80px] w-[114px] mb-8 stroke-[.71px]"
                fill="none"
                xmlns="http://www.w3.org/2000/svg" 
                viewBox="0 0 32.89 25.63">
                <path d="M.5.5h31.89v18.34H.5zM32.39 4.26A3.76 3.76 0 0128.63.5M28.63 18.84a3.76 3.76 0 013.76-3.76M.5 4.26A3.76 3.76 0 004.26.5M4.26 18.84A3.76 3.76 0 00.5 15.07"></path>
                <path d="M18.88 6.55a4 4 0 00-2.4-.77c-1.48 0-2.27.83-2.27 1.91s1.36 1.6 2.34 1.93S19 10.28 19 11.6s-1.43 1.76-2.4 1.76a5.32 5.32 0 01-2.73-1M16.48 4.82v9.7"></path>
                <path d="M.5 18.84h31.89v3.15H.5z"></path>
                <path d="M.5 21.98h31.89v3.15H.5z"></path>
              </svg>
              <h3 className="text-[1.35rem] text-[#333] font-semibold mb-8">3. Get Cash Fast</h3>
              <p className="max-w-[25rem] text-center">No need to wait for a buyer, get cash fast through ItsWorthMore.com.</p>
            </div>
        </div>
      </div>
    </section>
  );
};

export { HowItWorks }
