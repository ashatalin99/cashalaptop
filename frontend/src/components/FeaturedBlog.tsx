"use client";

const FeaturedBlog = () => {
  const blogs = [
    {
      title: "How to Prepare Your Laptop for Sale",
      excerpt: "Learn the best practices for cleaning and resetting your laptop before selling it.",
      link: "/blog/prepare-your-laptop-for-sale",
      thumb: "/blog/prepare-laptop.jpg"
    },
    {
      title: "Top 5 Tips for Getting the Best Price",
      excerpt: "Discover how to maximize your laptop's value with these expert tips.",
      link: "/blog/top-5-tips-for-best-price",
      thumb: "/blog/best-price-tips.jpg"
    },
    {
      title: "What to Do After Selling Your Laptop",
      excerpt: "Find out the steps you should take after selling your laptop to ensure a smooth transition.",
      link: "/blog/after-selling-your-laptop",  
      thumb: "/blog/after-sale-steps.jpg"
    }
  ];

  return (
    <section className="py-20 bg-[#F1F1F1]">
      <div className="container mx-auto px-8">
        <h2 className="text-3xl lg:text-4xl font-bold text-gray-900 mb-8 text-center">
          Featured Blogs
        </h2>
        <div className="grid md:grid-cols-3 gap-8">
          {blogs.map((blog, index) => (
            <div key={index} className="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300">
              <img src={blog.thumb} alt={blog.title} />
              <h3 className="text-xl font-semibold mt-4 mb-2">{blog.title}</h3>
              <p className="text-gray-600 mb-4">{blog.excerpt}</p>
              <a href={blog.link} className="text-blue-600 hover:text-blue-800">Read more</a>
            </div>
          ))}
        </div>
      </div>
    </section>
  );
}

export { FeaturedBlog };