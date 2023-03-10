import WindowWithFrontendKit from '../../WindowWithFrontendKit';

export default (): void => {
  const { boschFrontendKit } = (window as unknown) as WindowWithFrontendKit;

  const dialogExamples = document.getElementsByClassName(
    'frontend-kit-example_modal-dialog',
  );
  [...dialogExamples].forEach((container) => {
    // a trigger that launches the modal
    const trigger = container.getElementsByClassName('a-button')[0];
    // the dialog identifier
    const dialogId = container.getAttribute('data-frok-show-dialog');

    // the element containing the dialog
    const dialogElement = boschFrontendKit.Dialog.findDialog(dialogId);

    // the actual component
    const dialog = dialogElement.component;

    dialog.addEventListener('confirmed', () => dialog.hide());
    dialog.addEventListener('canceled', () => dialog.hide());
    dialog.addEventListener('backgroundClicked', () => dialog.hide());
    dialog.addEventListener('closeClicked', () => dialog.hide());

    if (trigger) {
      trigger.addEventListener('click', () =>
        boschFrontendKit.Dialog.showDialog(dialogId),
      );
    }
  });
};
