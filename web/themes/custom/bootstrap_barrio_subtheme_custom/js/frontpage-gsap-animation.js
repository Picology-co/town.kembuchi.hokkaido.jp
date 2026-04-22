// フロントページのGSAPアニメーション

// ステップ1
gsap.from("div.animation__step1__image", {
    y: -50,
    opacity: 0,
    duration: 1.2,
    ease: "power2.out",
    stagger: 0.2     // 0.2秒ずつずらして表示
});
