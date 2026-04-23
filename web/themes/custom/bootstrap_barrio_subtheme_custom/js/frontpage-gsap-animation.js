// フロントページのGSAPアニメーション

const PAGE_W = 280;
const book = "#book";
const cover = "#cover";
const pages = gsap.utils.toArray(".page");

// 初期状態:
// 開いたときの幅は2ページ分あるが、閉じた本を中央に見せるため
// 本全体を半ページ分だけ左にずらしておく
gsap.set(book, {
    x: -PAGE_W / 2
});

// 右側に積まれている順番
pages.forEach((page, i) => {
    gsap.set(page, {
    rotationY: 0,
    z: pages.length - i,
    zIndex: 20 - i
    });
});

gsap.set(cover, {
    rotationY: 0,
    z: 20,
    zIndex: 50
});

function flipHard(target, zIndex, finalAngle = -179.6, times = [0.10, 0.20, 0.14]) {
    const tl = gsap.timeline();

    tl.set(target, { zIndex });

    // 少し持ち上がる
    tl.to(target, {
    rotationY: -18,
    duration: times[0],
    ease: "power1.out"
    });

    // 中間まで回る
    tl.to(target, {
    rotationY: -95,
    duration: times[1],
    ease: "power2.in"
    });

    // 最後にパタッと倒れる
    tl.to(target, {
    rotationY: finalAngle,
    duration: times[2],
    ease: "power4.in"
    });

    return tl;
}

const master = gsap.timeline({
    defaults: { overwrite: "auto" }
});

// 閉じた本が中央 → 開いた本が中央になるように本全体を少し移動
master.to(book, {
    x: 0,
    duration: 0.95,
    ease: "power1.inOut"
}, 0);

// 表紙を開く
master.add(
    flipHard(cover, 100, -179.3, [0.16, 0.42, 0.22]),
    0.02
);

// 動画っぽく、最初の数ページはやや早め
master.add(flipHard(".page-1", 61, -179.6, [0.07, 0.15, 0.11]), 1.08);
master.add(flipHard(".page-2", 62, -179.6, [0.07, 0.15, 0.11]), 1.42);
master.add(flipHard(".page-3", 63, -179.6, [0.07, 0.15, 0.11]), 1.76);
master.add(flipHard(".page-4", 64, -179.6, [0.07, 0.15, 0.11]), 2.10);

// 最後の1枚は少しゆっくり
master.add(flipHard(".page-5", 65, -179.6, [0.14, 0.36, 0.22]), 2.70);

// 開いた状態で少し止める
master.to({}, { duration: 1.0 });
