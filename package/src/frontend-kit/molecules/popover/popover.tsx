import * as React from 'react';

import classNames from 'classnames';

import { Box } from '../../atoms/box/box';
import { Button } from '../../atoms/button/button';

import { ArrowPosition } from './constants';

class PopoverProps {
  headline?: string;
  paragraph?: string;
  buttonLabel?: string;
  closeButton?: boolean;
  detached?: boolean;
  arrowPosition?: ArrowPosition;
  isPopoverArrowMissing?: boolean;
  children?: React.ReactNode;
}

/**
 * @name      m-popover
 * @type      molecule
 * @author    Experience One AG
 * @copyright Robert Bosch GmbH
 *
 * @param       headline                Headline text when defined
 * @param       paragraph               Paragraph text
 * @param       buttonLabel             Label of action button when displayed
 * @param       closeButton             Wether or not show close icon in the right top corner
 * @param       arrowPosition           Position of the arrow
 * @param       detached                Wether or not the popover should be detached. An attached popover will be positioned absolutely to point to a given DOM element.
 * @param       isPopoverArrowMissing   Wether or not the arrow should appear. Deafult is shown.
 * @param       children                Wether or not include any other content different from paragraphs.
 *
 * @description
 * A popover is a larger variant of the tooltip. It can optionally have a button, a close button, or a headline, and one of 12 arrow positions.
 */
const Popover: React.FunctionComponent<PopoverProps> = ({
  headline,
  paragraph,
  buttonLabel,
  closeButton,
  arrowPosition,
  detached = true,
  isPopoverArrowMissing,
  children,
}) => {
  const popoverClasses = classNames([
    'm-popover',
    { [`-${arrowPosition}`]: arrowPosition },
    { '-close-button': closeButton },
    { '-detached': detached },
    { '-without-arrow': isPopoverArrowMissing },
  ]);
  return (
    <div className={popoverClasses}>
      <Box>
        <div className="m-popover__content">
          {(headline || closeButton) && (
            <div className="m-popover__head">
              {headline}
              {closeButton && (
                <Button
                  action="close"
                  mode="integrated"
                  icon="close"
                  aria-label="close popover"
                  isUiIcon
                />
              )}
            </div>
          )}
          {paragraph && <div className="m-popover__paragraph">{paragraph}</div>}
          {buttonLabel && (
            <Button label={buttonLabel} mode="primary" action="confirm" />
          )}
          {children}
        </div>
      </Box>
    </div>
  );
};

export { Popover, PopoverProps };
