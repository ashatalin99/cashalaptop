"use client";
import { Button } from "@/components/ui/button";
import { Menu, Phone } from "lucide-react";
import Image from "next/image";

export const Header = () => {
  return (
    <header className="bg-[#333] sticky top-0 z-50">
      <div className="container mx-auto px-4 sm:px-6 lg:px-8 flex justify-between">
        <div>
          <img 
            src="/logo4.png"
            alt="Logo"
            className="w-[110px] my-4"
          />
        </div>
        <div>
          <ul className="flex h-full items-center space-x-2">
            <li className="hover:bg-[#222] flex items-center h-full px-2">
              <a href="#" className="text-white uppercase font-semibold hover:text-[#56C3E0] text-[0.85rem]">Start Selling</a>
              <ul>
                <li><a href=""></a></li>
                <li><a href=""></a></li>
                <li><a href=""></a></li>
                <li><a href=""></a></li>
                <li><a href=""></a></li>
                <li><a href=""></a></li>
                <li><a href=""></a></li>
                <li><a href=""></a></li>
                <li><a href=""></a></li>
                <li><a href=""></a></li>
                <li><a href=""></a></li>
                <li><a href=""></a></li>
              </ul>
            </li>
            <li className="hover:bg-[#222] flex items-center h-full px-2"><a href="#" className="text-white uppercase font-semibold hover:text-[#56C3E0] text-[0.85rem] transition-colors duration-200">Sell in Bulk</a></li>
            <li className="hover:bg-[#222] flex items-center h-full px-2"><a href="#" className="text-white uppercase font-semibold hover:text-[#56C3E0] text-[0.85rem] transition-colors duration-200">Buy Refurbished</a></li>
            <li className="hover:bg-[#222] flex items-center h-full px-2"><a href="#" className="text-white uppercase font-semibold hover:text-[#56C3E0] text-[0.85rem] transition-colors duration-200">Support</a></li>
            <li>
              <button className="w-[25px] h-[25px]">
                <svg 
                  className="fill-current text-white hover:text-[#56C3E0] transition-colors duration-200"
                  aria-hidden="true"
                  viewBox="0 0 23 19" 
                  xmlns="http://www.w3.org/2000/svg">
                    <path d="M7.45703 12.6667H19.6309C19.9318 12.6667 20.1969 12.4809 20.2777 12.2064L22.973 3.33978C23.0314 3.14978 22.991 2.94289 22.8652 2.78244C22.7395 2.622 22.5373 2.52911 22.3262 2.52911H5.90273L5.42207 0.494C5.3502 0.206889 5.07617 0 4.76172 0H0.673828C0.300977 0 0 0.282889 0 0.633333C0 0.983778 0.300977 1.26667 0.673828 1.26667H4.22266L6.65742 11.5604C5.94316 11.8518 5.44004 12.5231 5.44004 13.3042C5.44004 14.3513 6.34746 15.2042 7.46152 15.2042H19.6354C20.0082 15.2042 20.3092 14.9213 20.3092 14.5709C20.3092 14.2204 20.0082 13.9376 19.6354 13.9376H7.45703C7.08418 13.9376 6.7832 13.6547 6.7832 13.3042C6.7832 12.9538 7.08418 12.6667 7.45703 12.6667Z"></path>
                    <path d="M6.7832 17.1C6.7832 18.1471 7.69063 19 8.80469 19C9.91875 19 10.8262 18.1471 10.8262 17.1C10.8262 16.0528 9.91875 15.2 8.80469 15.2C7.69063 15.2 6.7832 16.0528 6.7832 17.1Z"></path>
                    <path d="M16.2617 17.1C16.2617 18.1471 17.1691 19 18.2832 19C19.3973 19 20.3047 18.1471 20.3047 17.1C20.3047 16.0528 19.3973 15.2 18.2832 15.2C17.1691 15.2 16.2617 16.0528 16.2617 17.1Z"></path>
                </svg>  
              </button>
            </li>
          </ul>
        </div>
      </div>
    </header>
  );
};
