// フロントページのGSAPアニメーション

const tl = gsap.timeline();

gsap.to(".green", { rotation: 360, x: 400, duration: 2 });

gsap.from(".purple", { rotation: -360, x: -200, duration: 3 });

gsap.fromTo(".blue", { x: -100 }, { rotation: 360, x: 800, duration: 5 });