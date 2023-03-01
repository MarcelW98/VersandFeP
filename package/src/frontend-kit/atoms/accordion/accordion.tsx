import * as React from 'react';
import classNames from 'classnames';
import { Icon } from '../icon/icon';

class AccordionProps {
  open?: boolean;
  headline: string;
  size?: 'small' | 'large';
}

/**
 * @name        a-accordion
 * @type        atom
 *
 * @param       open            Whether the Accordion is open or not
 * @param       headline        The headline of the Accordion
 * @param       size            The size of the Accordion
 * @description
 * representation of a accordion
 */

const Accordion: React.FunctionComponent<AccordionProps> = ({
  open = false,
  headline,
  size = 'large',
}: AccordionProps) => {
  const divClass = classNames('a-accordion', {
    'a-accordion--open': open,
    'a-accordion--small': size === 'small',
  });

  return (
    <div className={divClass}>
      <div className="a-accordion__headline">
        <div className="a-accordion__headline-text highlight">{headline}</div>

        {open ? (
          <Icon iconName="up" className="a-accordion__headline-icon" />
        ) : (
          <Icon iconName="down" className="a-accordion__headline-icon" />
        )}
      </div>
      <div className="a-accordion__content">
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Ratione
        quibusdam blanditiis recusandae labore veritatis, rem at voluptates vero
        reprehenderit tempore?
      </div>
    </div>
  );
};

export { Accordion, AccordionProps };
