"use client";
import { Input } from "./ui/input";
import type { DeviceView } from "@/types/DeviceView";

const StartSelling = ({title, subtitle, inputPlaceholder, quickLinks, devices}: DeviceView) => {
    return (
    <section className="flex flex-col items-center justify-center bg-[#F1F1F1] border border-t-[#ddd] border-b-[#ddd] py-26">
        <h3 className="text-[2.25rem] font-semibold mb-3 leading-[1.4] text-[#222]">{title}</h3>
        <p className="text-[1.25rem] text-[#666] mb-6">{subtitle}</p>
        <div className="mx-auto px-4 w-[800px]">
            <Input 
                className="border border-[#bbb] bg-white text-[1rem] mx-auto w-full px-4 py-3 rounded-sm focus:outline-none focus:border-none focus-ring-1 focus:ring-[#1e90fe] placeholder:text-[rgba(0,0,0,.75)]"
                placeholder={inputPlaceholder}
                type="text"
                aria-label="Search for your laptop model or brand"
                autoComplete="off"
                spellCheck="false"
                autoFocus
                role="searchbox"
            />
        </div>
        <div className="flex flex-col sm:flex-row items-center justify-between mt-6">
            <dl className="flex flex-col items-center sm:flex-row mx-auto mb-6">
                <dt className="font-semibold text-[12px]">Quick Links:</dt>
                {
                    quickLinks.map(link => (
                        <dd key={link.link.title} className="mx-1">
                            <a href={link.link.url} target={link.link.target} className="bg-[var(--grey-100)] border border-[var(--grey-200)] p-2 rounded-sm hover:bg-[var(--grey-200)] transition-colors">
                                {link.link.title}
                            </a>
                        </dd>
                    ))
                }
            </dl>
        </div>
        <div>
            <ul className="max-w-7xl grid grid-cols-4 grid-rows-3 bg-[#fbfbfb]">
                {devices.map((device) => (
                    <li key={device.deviceName.title} className="flex items-center flex-col justify-center text-center border border-gray-300 -mt-px -ml-px hover:shadow-[0_0_15px_rgba(0,0,0,0.5)]">
                        <a href={device.deviceName.url} target={device.deviceName.target} className="px-18 py-4 h-full w-full">
                            <img src={device.icon.src} alt={device.icon.alt} className="w-[120px] h-[120px] mx-auto" />
                            <h4 className="text-[20px] text-center font-semibold">{device.deviceName.title}</h4>
                        </a>
                    </li>
                ))}
            </ul>
        </div>
    </section>
  );
}

export { StartSelling }