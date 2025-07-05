"use client";

const FullHero = () => {
  return (
    <section className="relative bg-[url(/hero-min.jpg)] bg-cover bg-center bg-bottom bg-no-repeat py-40 after:content-[''] after:absolute after:inset-0 after:bg-[#222]/90">
      <div className="container mx-auto px-4 relative z-10">
        <h1 className="text-4xl sm:text-4xl md:text-5xl lg:text-[3.25rem] font-bold text-white text-center leading-tight uppercase">
            Trade-in your used<br />
            electronics <em className="lowercase font-light">for </em><span className="text-[#56C3E0] font-light uppercase">cash</span>
        </h1>
        <p className="text-[1.5rem] text-center text-[#d4d4d4] py-4">The simplest and safest way to sell your old phone, tablet, or laptop online</p>
        <div className="text-center">
            <a href="#get-quote" className="mt-8 mx-auto inline-flex items-center bg-[#ED6C0B] text-white font-semibold py-3 px-6 rounded-sm hover:bg-[#C95C09] transition-colors">
                Sell you device
            </a>
        </div>
      </div>
    </section>
  );
}

export { FullHero }