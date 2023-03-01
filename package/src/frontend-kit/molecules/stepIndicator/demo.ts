import WindowWithFrontendKit from '../../WindowWithFrontendKit';

export default (): void => {
  const ACTIVE_CLASS = '-active';
  const dialogExamples = document.getElementsByClassName(
    'frontend-kit-example__step-indicator-example',
  );

  const setActiveState = (elements, counter) => {
    elements.forEach((element, index) => {
      element.classList.remove(ACTIVE_CLASS);

      if (index + 1 <= counter) element.classList.add(ACTIVE_CLASS);
    });
  };

  [...dialogExamples].forEach((container) => {
    // internal counter which step is active
    let activeStep = 1;

    // get trigger
    const prevTrigger = container.querySelector('.step-indicator__prev');
    const nextTrigger = container.querySelector('.step-indicator__next');

    // get steps
    const steps = [...container.querySelectorAll('.m-step-indicator__step')];
    const maxSteps = steps.length;

    // activate prev step
    prevTrigger.addEventListener('click', (e) => {
      if (activeStep > 0) {
        activeStep = activeStep - 1 <= 0 ? 0 : activeStep - 1;
        setActiveState(steps, activeStep);
      }
    });

    // activate next step
    nextTrigger.addEventListener('click', (e) => {
      if (activeStep < maxSteps) {
        activeStep = activeStep + 1 <= maxSteps ? activeStep + 1 : maxSteps;
        setActiveState(steps, activeStep);
      }
    });
  });
};
