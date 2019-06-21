export default function menu__collapseSection(element) {
  // https://codepen.io/brundolf/pen/dvoGyw

  // get the height of the element's inner content, regardless of its actual size
  const sectionHeight = element.scrollHeight;
  const links = element.querySelectorAll("li");

  // temporarily disable all css transitions
  const elementTransition = element.style.transition;
  element.style.transition = "";

  // on the next frame (as soon as the previous style change has taken effect),
  // explicitly set the element's height to its current pixel height, so we
  // aren't transitioning out of 'auto'
  requestAnimationFrame(function() {
    element.style.height = sectionHeight + "px";
    element.style.transition = elementTransition;

    // on the next frame (as soon as the previous style change has taken effect),
    // have the element transition to height: 0
    requestAnimationFrame(function() {
      element.style.height = 0 + "px";
    });
  });
  // mark the section as "currently collapsed"
  element.setAttribute("data-collapsed", "true");
}