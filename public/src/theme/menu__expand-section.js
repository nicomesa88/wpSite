export default function menu__expandSection(element) {
  // get the height of the element's inner content, regardless of its actual size
  const sectionHeight = element.scrollHeight;
  const links = element.querySelectorAll("li");

  // have the element transition to the height of its inner content
  element.style.height = sectionHeight + "px";

  // remove "height" from the element's inline styles, so it can return to its initial value
  function removeInlineStyles() {
    element.style.height = null;
  }

  element.addEventListener("transitionend", function onTransitionEnded() {
    // remove this event listener so it only gets triggered once
    element.removeEventListener("transitionend", removeInlineStyles);
  });

  // mark the section as "currently not collapsed"
  element.setAttribute("data-collapsed", "false");
}