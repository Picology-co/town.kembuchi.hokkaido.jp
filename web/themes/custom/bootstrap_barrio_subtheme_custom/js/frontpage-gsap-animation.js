// フロントページのGSAPアニメーション

// ステップ1
gsap.from("div.animation__step1__image down", {
    y: -1024,
    opacity: 0,
    duration: 1.2,
    ease: "power2.out",
    stagger: 3.0
});

gsap.from("div.animation__step1__image up", {
    y: 1024,
    opacity: 0,
    duration: 1.2,
    ease: "power2.out",
    stagger: 3.0
});
