import TabNavigation from '.';
import ElementWithComponent from '../../ElementWithComponent';

export default (): void => {
  const contents = Array.from(
    document.querySelectorAll(
      '.frontend-kit-example_tabbed-content .frontend-kit-example_content',
    ),
  ) as HTMLDivElement[];
  const tabs = document.querySelector(
    '.frontend-kit-example_tabbed-content .a-tab-navigation',
  );

  if (tabs) {
    const { component } = tabs as ElementWithComponent<TabNavigation>;

    component.addEventListener('selected', (id: string) => {
      contents.forEach(content => {
        if (content.dataset.frokContentIdentifier === id) {
          /* eslint-disable-next-line no-param-reassign */
          content.style.display = 'block';
        } else {
          /* eslint-disable-next-line no-param-reassign */
          content.style.display = 'none';
        }
      });
    });
  }
};
