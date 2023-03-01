import WindowWithFrontendKit from '../../WindowWithFrontendKit';

export default (): void => {
  const { boschFrontendKit } = (window as unknown) as WindowWithFrontendKit;

  const lightboxExamples = document.getElementsByClassName(
    'frontend-kit-example_modal-lightbox',
  );

  [...lightboxExamples].forEach(container => {
    // a trigger that launches the modal
    const trigger = container.getElementsByClassName('a-button')[0];
    // the lightbox identifier
    const lightboxId = container.getAttribute('data-frok-show-lightbox');

    // the element containing the lightbox
    const lightboxElement = boschFrontendKit.Lightbox.findLightbox(lightboxId);

    // the actual component
    const lightbox = lightboxElement.component;

    lightbox.addEventListener('closeClicked', () => lightbox.hide());
    lightbox.addEventListener('next', (index: number) => lightbox.next(index));
    lightbox.addEventListener('back', (index: number) => lightbox.back(index));
    lightbox.addEventListener('backgroundClicked', () => lightbox.hide());

    if (trigger){
      trigger.addEventListener('click', () =>
        boschFrontendKit.Lightbox.showLightbox(lightboxId),
      );
    }
  });
};
