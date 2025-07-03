"use client";
import { Button } from "@/components/ui/button";
import { Input } from "@/components/ui/input";
import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from "@/components/ui/select";
import { Search, Star } from "lucide-react";

export const Hero = () => {
  return (
    <section id="home" className="bg-gradient-to-br from-blue-50 to-indigo-100 py-20">
      <div className="container mx-auto px-4">
        <div className="grid lg:grid-cols-2 gap-12 items-center">
          <div className="space-y-8">
            <div className="space-y-4">
              <h1 className="text-4xl lg:text-6xl font-bold text-gray-900 leading-tight">
                Sell Your Laptop for 
                <span className="text-blue-600"> Top Dollar</span>
              </h1>
              <p className="text-xl text-gray-600">
                Get instant quotes, free shipping, and fast payments. We buy all laptop brands in any condition.
              </p>
            </div>
            
            <div className="flex items-center space-x-2 text-yellow-500">
              {[...Array(5)].map((_, i) => (
                <Star key={i} className="h-5 w-5 fill-current" />
              ))}
              <span className="text-gray-600 ml-2">4.9/5 from 10,000+ customers</span>
            </div>
            
            <div className="bg-white p-6 rounded-2xl shadow-lg">
              <h3 className="text-lg font-semibold mb-4">Get Your Free Quote</h3>
              <div className="space-y-4">
                <div className="grid grid-cols-2 gap-4">
                  <Select>
                    <SelectTrigger>
                      <SelectValue placeholder="Brand" />
                    </SelectTrigger>
                    <SelectContent>
                      <SelectItem value="apple">Apple</SelectItem>
                      <SelectItem value="dell">Dell</SelectItem>
                      <SelectItem value="hp">HP</SelectItem>
                      <SelectItem value="lenovo">Lenovo</SelectItem>
                      <SelectItem value="asus">ASUS</SelectItem>
                    </SelectContent>
                  </Select>
                  
                  <Input placeholder="Model (e.g., MacBook Pro)" />
                </div>
                
                <Button className="w-full bg-blue-600 hover:bg-blue-700 text-lg py-6">
                  <Search className="mr-2 h-5 w-5" />
                  Get My Quote
                </Button>
              </div>
            </div>
          </div>
          
          <div className="relative">
            <img 
              src="https://images.unsplash.com/photo-1531297484001-80022131f5a1?auto=format&fit=crop&w=800&q=80"
              alt="Laptop on desk"
              className="rounded-2xl shadow-2xl"
            />
            <div className="absolute -bottom-6 -left-6 bg-white p-4 rounded-xl shadow-lg">
              <div className="text-center">
                <div className="text-2xl font-bold text-green-600">$850</div>
                <div className="text-sm text-gray-500">Average payout</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  );
};
