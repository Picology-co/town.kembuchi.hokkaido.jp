// フロントページのGSAPアニメーション

const PAGE_W = 280;
const book = "#book";
const cover = "#cover";
const pages = gsap.utils.toArray(".page");

gsap.set(book, {
    x: -PAGE_W / 2
});

pages.forEach((page, i) => {
    gsap.set(page, {
    rotationY: 0,
    rotationX: 0,
    z: pages.length - i,
    y: 0,
    x: 0,
    zIndex: 20 - i,
    transformOrigin: "0% 50%"
    });
});

gsap.set(cover, {
    rotationY: 0,
    rotationX: 0,
    z: 18,
    y: 0,
    x: 0,
    zIndex: 60,
    transformOrigin: "0% 50%"
});

function flipCover3D(target, zIndex) {
    const shadowEl = document.querySelector(`${target} .cover-shadow`);
    const tl = gsap.timeline();

    tl.set(target, { zIndex });

    tl.to(target, {
    rotationY: -10,
    rotationX: 0,
    z: 0,
    y: 0,
    duration: 0.12,
    ease: "sine.out"
    });

    tl.to(shadowEl, {
    opacity: 0.06,
    duration: 0.12,
    ease: "sine.out"
    }, "<");

    tl.to(target, {
    rotationY: -25,
    rotationX: 0,
    z: 0,
    y: 0,
    duration: 0.12,
    ease: "sine.out"
    });

    tl.to(shadowEl, {
    opacity: 0.06,
    duration: 0.12,
    ease: "sine.out"
    }, "<");

    tl.to(target, {
    rotationY: -50,
    rotationX: 0,
    z: 0,
    y: 0,
    duration: 0.12,
    ease: "sine.out"
    });

    tl.to(shadowEl, {
    opacity: 0.06,
    duration: 0.12,
    ease: "sine.out"
    }, "<");

    tl.to(target, {
    rotationY: -75,
    rotationX: 0,
    z: 0,
    y: 0,
    duration: 0.12,
    ease: "sine.out"
    });

    tl.to(shadowEl, {
    opacity: 0.06,
    duration: 0.12,
    ease: "sine.out"
    }, "<");

    tl.to(target, {
    rotationY: -90,
    rotationX: 0,
    z: 0,
    y: 0,
    duration: 0.18,
    ease: "power1.out"
    });

    tl.to(shadowEl, {
    opacity: 0.14,
    duration: 0.18,
    ease: "power1.out"
    }, "<");

    tl.to(target, {
    rotationY: -105,
    rotationX: 0,
    z: 0,
    y: 0,
    duration: 0.30,
    ease: "power2.inOut"
    });

    tl.to(shadowEl, {
    opacity: 0.24,
    duration: 0.30,
    ease: "power2.inOut"
    }, "<");

    tl.to(target, {
    rotationY: -170,
    rotationX: 0,
    z: 0,
    y: 0,
    duration: 0.22,
    ease: "power2.in"
    });

    tl.to(shadowEl, {
    opacity: 0.10,
    duration: 0.22,
    ease: "power2.in"
    }, "<");

    tl.to(target, {
    rotationY: -180,
    rotationX: 0,
    z: 0,
    y: 0,
    x: 0,
    duration: 0.10,
    ease: "sine.out"
    });

    tl.to(shadowEl, {
    opacity: 0.04,
    duration: 0.10,
    ease: "sine.out"
    }, "<");

    return tl;
}

function flipPage3D(target, zIndex, options = {}) {
    const {
    liftZ = 20,
    liftY = -7,
    tiltX = -4,
    times = [0.16, 0.30, 0.24, 0.10]
    } = options;

    const shadowEl = document.querySelector(`${target} .page-shadow`);
    const tl = gsap.timeline();

    tl.set(target, { zIndex });

    tl.to(target, {
    rotationY: -10,
    rotationX: 0,
    z: liftZ * 0.18,
    y: liftY * 0.18,
    x: 0,
    duration: times[0],
    ease: "sine.out"
    });

    tl.to(shadowEl, {
    opacity: 0.12,
    duration: times[0],
    ease: "sine.out"
    }, "<");

    tl.to(target, {
    rotationY: -82,
    rotationX: 0,
    z: liftZ * 0.18,
    y: liftY * 0.18,
    x: 0,
    duration: times[1],
    ease: "power2.inOut"
    });

    tl.to(shadowEl, {
    opacity: 0.26,
    duration: times[1],
    ease: "power2.inOut"
    }, "<");

    tl.to(target, {
    rotationY: -168,
    rotationX: 0,
    z: 5,
    y: -1,
    x: 0,
    duration: times[2],
    ease: "power2.in"
    });

    tl.to(shadowEl, {
    opacity: 0.08,
    duration: times[2],
    ease: "power2.in"
    }, "<");

    tl.to(target, {
    rotationY: -180,
    rotationX: 0,
    z: 0,
    y: 0,
    x: 0,
    duration: times[3],
    ease: "sine.out"
    });

    tl.to(shadowEl, {
    opacity: 0,
    duration: times[3],
    ease: "sine.out"
    }, "<");

    return tl;
}

const master = gsap.timeline({
    defaults: { overwrite: "auto" }
});

master.to(book, {
    x: 0,
    duration: 1.10,
    ease: "power2.out"
}, 0);

master.add(flipCover3D(cover, 100), 0.04);

master.add(
    flipPage3D(".page-1", 61, {
    liftZ: 18,
    liftY: -6,
    tiltX: -3.5,
    times: [0.16, 0.30, 0.24, 0.10]
    }),
    1.04
);

master.add(
    flipPage3D(".page-2", 62, {
    liftZ: 18,
    liftY: -6,
    tiltX: -3.5,
    times: [0.16, 0.30, 0.24, 0.10]
    }),
    1.34
);

master.add(
    flipPage3D(".page-3", 63, {
    liftZ: 18,
    liftY: -6,
    tiltX: -3.5,
    times: [0.16, 0.30, 0.24, 0.10]
    }),
    1.64
);

master.add(
    flipPage3D(".page-4", 64, {
    liftZ: 20,
    liftY: -7,
    tiltX: -4,
    times: [0.16, 0.30, 0.24, 0.10]
    }),
    1.94
);

master.add(
    flipPage3D(".page-5", 65, {
    liftZ: 24,
    liftY: -8,
    tiltX: -4.5,
    times: [0.16, 0.30, 0.24, 0.10]
    }),
    2.28
);

master.to({}, { duration: 1.0 });
