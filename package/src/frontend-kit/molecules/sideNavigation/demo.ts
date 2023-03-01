export default (): void => {
  const sideNavigationExamples = document.getElementsByClassName(
    'frontend-kit-example_side-navigation',
  );

  [...sideNavigationExamples].forEach((container) => {
    const trigger = container.querySelector(
      '.a-button[data-frok-action="show"]',
    );

    const componentContainer = container.getElementsByClassName(
      'm-side-navigation',
    )[0];

    const linkItems = container.querySelectorAll('.m-side-navigation__link');

    const updateActiveState = (item: HTMLElement, items: HTMLElement[]) => {
      // reset active states
      items.forEach((element: HTMLElement) => {
        element.classList.remove('-selected');
      });

      // put active state on clicked link
      item.classList.add('-selected');
    };

    linkItems.forEach((linkItem) =>
      linkItem.addEventListener('click', () =>
        updateActiveState(linkItem, linkItems),
      ),
    );

    const sideNavigation = componentContainer.component;

    trigger.addEventListener('click', () => sideNavigation.show());
  });
};
