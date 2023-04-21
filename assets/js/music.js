let titleFisrtSection = document.querySelector(".block-title span.title1");
let titleSecondSection = document.querySelector(".block-title span.title2");
let titleThirdSection = document.querySelector(".block-title span.title3");
let titleDotsSection = document.querySelector(".block-title span.title-dots");
let epCover = document.querySelectorAll(".album-infos-container img.ep-js");
let epIframe = document.querySelectorAll(".iframe-js");

window.onload = function () {
  titleFisrtSection.style.opacity = "1";

  titleSecondSection.style.opacity = "1";

  titleThirdSection.style.opacity = "1";

  titleDotsSection.style.opacity = "1";
};

console.log(epIframe);

epCover.forEach((element, index) => {
  let eltFrame = document.getElementById("iframe-js-" + index);
  element.addEventListener("mouseenter", (e) => {
    e.stopPropagation();
    console.log(index);
    eltFrame.classList.add("iframe-js-show");

    eltFrame.addEventListener("mouseenter", () => {
      eltFrame.classList.add("iframe-js-show");
    });

    element.addEventListener("mouseleave", () => {
      eltFrame.classList.remove("iframe-js-show");
    });
  });
});
