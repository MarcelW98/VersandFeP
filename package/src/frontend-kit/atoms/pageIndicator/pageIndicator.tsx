import * as React from 'react';
import classNames from 'classnames';
import createPaginationArray from './functions/createPaginationArray';

class PageIndicatorProps {
  name?: string;
  pages: number;
  numbered?: boolean;
  disabled?: boolean;
  selected?: number;
}

/**
 * @name    a-pageIndicator
 * @type    atom
 * @author Experience One AG
 * @copyright Robert Bosch GmbH
 * @param   {string} label          Label of PageIndicator
 * @description
 * representation of Page Indicator elements
 */
const PageIndicator: React.FunctionComponent<PageIndicatorProps> = ({
  name,
  pages,
  numbered,
  disabled,
  selected = 1,
}: PageIndicatorProps) => {
  const elementClass = classNames('a-page-indicator', {
    '-disabled': disabled,
    'a-page-indicator--numbered': numbered,
  });

  let pageArray = [];

  if (numbered) {
    pageArray = createPaginationArray(selected, pages);
  } else {
    for (let i = 1; i < pages + 1; i += 1) {
      pageArray.push(i);
    }
  }

  return (
    <div
      className={elementClass}
      data-start-index={selected}
      data-max-length={pages}
      role="navigation"
      aria-label={`page-indicator-${name}`}
    >
      {numbered && <div className="a-page-indicator__caret -left" />}
      <div className="a-page-indicator__container">
        {pageArray.map((page, index) => {
          const indicatorClass = classNames('a-page-indicator__indicator', {
            '-selected': selected === page,
          });

          return (
            <div
              className={indicatorClass}
              key={index}
              data-index={typeof page === 'number' ? page : null}
            >
              {numbered && <span>{page}</span>}
            </div>
          );
        })}
      </div>
      {numbered && <div className="a-page-indicator__caret -right" />}
    </div>
  );
};

export { PageIndicator, PageIndicatorProps };
