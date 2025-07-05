"use client";

import { Input } from "./ui/input";

const StartSelling = () => {
  return (
    <section className="flex flex-col items-center justify-center bg-[#F1F1F1] border border-t-[#ddd] border-b-[#ddd] py-26">
        <h3 className="text-[2.25rem] font-semibold mb-3 leading-[1.4] text-[#222]">Start Selling</h3>
        <p className="text-[1.25rem] text-[#666] mb-6">Find the product you'd like to trade-in for cash</p>
        <div className="mx-auto px-4 w-[800px]">
            <Input 
                className="border border-[#bbb] bg-white text-[1rem] mx-auto w-full px-4 py-3 rounded-sm focus:outline-none focus:border-none focus-ring-1 focus:ring-[#1e90fe] placeholder:text-[rgba(0,0,0,.75)]"
                placeholder="Search for your device"
                type="text"
                aria-label="Search for your laptop model or brand"
                autoComplete="off"
                spellCheck="false"
                autoFocus
                role="searchbox"
            />
            <div className="flex flex-col sm:flex-row items-center justify-between my-6">
                <dl className="flex flex-col items-center sm:flex-row mx-auto">
                    <dt className="font-semibold text-[12px]">Quick Links:</dt>
                    <dd><a href="" className="bg-[var(--grey-100)] border border-[var(--grey-200)] p-2 mx-1 rounded-sm">Sell iPhone</a></dd>
                    <dd><a href="" className="bg-[var(--grey-100)] border border-[var(--grey-200)] p-2 mx-1 rounded-sm">Sell Samsung</a></dd>
                    <dd><a href="" className="bg-[var(--grey-100)] border border-[var(--grey-200)] p-2 mx-1 rounded-sm">Sell iPad</a></dd>
                    <dd><a href="" className="bg-[var(--grey-100)] border border-[var(--grey-200)] p-2 mx-1 rounded-sm">Sell MacBook</a></dd>
                    <dd><a href="" className="bg-[var(--grey-100)] border border-[var(--grey-200)] p-2 mx-1 rounded-sm">Sell iMac</a></dd>
                </dl>
            </div>
        </div>
    </section>
  );
}

export { StartSelling }