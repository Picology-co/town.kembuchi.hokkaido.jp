// フロントページのGSAPアニメーション

// ステップ1
gsap.from("div.animation__step1__image", {
    y: -1024,
    opacity: 0,
    duration: 3.0,
    ease: "power2.out",
    stagger: 3.0     // 0.2秒ずつずらして表示
});
