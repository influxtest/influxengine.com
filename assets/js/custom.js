let parallax = gsap.utils.toArray(".parallax");

parallax.forEach(para => {
    // used matchedMedia to lower the y axis for the parallax on mobile
    ScrollTrigger.matchMedia({
        // desktop
        "(min-width: 1281px)": function() {
            gsap.to(para, {
                y: 40,
                scrollTrigger: {
                    trigger: para,
                    start: "top center",
                    // end: "top -75px",
                    scrub: true,
                }
            });
        },
        // tablet
        "(max-width: 1281px)": function() {
            gsap.to(para, {
                
                y: 1,
                scrollTrigger: {
                    trigger: para,
                    start: "top center",
                    scrub: true,
                }
            });
        },
    });
});