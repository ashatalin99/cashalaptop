
import { Shield, Truck, DollarSign, Clock } from "lucide-react";

export const Features = () => {
  const features = [
    {
      icon: DollarSign,
      title: "Best Prices Guaranteed",
      description: "We offer the highest prices in the market. If you find a better offer, we'll match it."
    },
    {
      icon: Truck,
      title: "Free Shipping",
      description: "We provide prepaid shipping labels. Pack your laptop and send it to us for free."
    },
    {
      icon: Clock,
      title: "Fast Payment",
      description: "Get paid within 24 hours of us receiving your laptop. No waiting around."
    },
    {
      icon: Shield,
      title: "Secure & Safe",
      description: "Your data is wiped securely and your laptop is handled with care throughout the process."
    }
  ];

  return (
    <section className="py-20 bg-white">
      <div className="container mx-auto px-4">
        <div className="text-center mb-16">
          <h2 className="text-3xl lg:text-4xl font-bold text-gray-900 mb-4">
            Why Choose Cash A Laptop?
          </h2>
          <p className="text-xl text-gray-600 max-w-2xl mx-auto">
            We make selling your laptop simple, secure, and profitable
          </p>
        </div>
        
        <div className="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
          {features.map((feature, index) => (
            <div key={index} className="text-center group">
              <div className="bg-blue-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-6 group-hover:bg-blue-200 transition-colors">
                <feature.icon className="h-8 w-8 text-blue-600" />
              </div>
              <h3 className="text-xl font-semibold text-gray-900 mb-3">
                {feature.title}
              </h3>
              <p className="text-gray-600">
                {feature.description}
              </p>
            </div>
          ))}
        </div>
      </div>
    </section>
  );
};
