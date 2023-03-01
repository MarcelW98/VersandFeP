export default (): void => {
  const contextMenuExamples = document.getElementsByClassName(
    'frontend-kit-example_context-menu',
  );

  [...contextMenuExamples].forEach((container) => {
    const componentContainer = container.getElementsByClassName(
      'o-context-menu',
    )[0];

    const exampleTexts = container.getElementsByClassName(
      'example-text-context-menu',
    )[0];

    const popovers = container.getElementsByClassName('m-popover')[0];

    popovers.style.top = '0';
    popovers.style.left = '0';
    popovers.style.zIndex = '999';

    exampleTexts.addEventListener('click', () => {
      if (componentContainer.classList.contains('-visible')) {
        componentContainer.classList.remove('-visible');
      } else {
        componentContainer.classList.add('-visible');
      }
    });

    popovers.addEventListener('mouseleave', () => {
      componentContainer.classList.remove('-visible');
    });
  });
};
