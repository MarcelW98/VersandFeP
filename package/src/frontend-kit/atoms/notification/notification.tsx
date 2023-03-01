import classNames from 'classnames';
import * as React from 'react';
import { Button } from '../button/button';
import { Icon } from '../icon/icon';
import { Link } from '../link/link';
import NotificationComponent from './index';



interface NotificationProps {
  name?: string;
  variant?: 'banner' | 'text';
  type?: 'neutral' | 'success' | 'warning' | 'error';
  iconName?: string;
  notificationId?: string;
  children?: React.ReactNode;
  content?: React.ReactNode;
}

/**
 * @name        a-notification
 * @type        atom
 *
 * @param       name            optional
 *                              Variant name.
 * @param       variant         optional
 *                              if not passed 'bar' type will be generated.
 *                              Other variants are 'banner', 'text'
 * @param       type            optional
 *                              default will be neutral, other types are 'success', 'warning', 'error'
 * @param       iconName        optional
 *                              icon name will only be used when type is neutral
 * @param       notificationId  optional, only needed when notification is banner variant
 * @param       children        optional, gets inserted into the inner div of the notification
 * @param       content         optional, replaces inner div of notification
 *
 * @description
 * representation of a notification
 */

const Notification: React.FunctionComponent<NotificationProps> = ({
  name,
  variant,
  type = 'neutral',
  iconName,
  notificationId,
  children,
  content,
}) => {
  const labelIdName = name
    ? name.toLowerCase().replace(/\s/g, '-').replace(/[()]/g, '')
    : variant;

  const notificationLabelId = notificationId
    ? `${notificationId}-label`
    : `notification-label-id-${labelIdName}-${type}`;

  // construction of class names
  const notificationClass = classNames('a-notification', {
    [`a-notification--${variant}`]: variant,
    [`-${type}`]: type,
  });

  return (
    <div
      className={notificationClass}
      id={
        notificationId
          ? NotificationComponent.notificationId(notificationId)
          : null
      }
      role="alert"
    >
      {/* if not neutral variant, a icon is mandatory and a uiIcon */}
      {type !== 'neutral' && (
        <Icon iconName={`alert-${type}`} isUiIcon titleText="Loren Ipsum" />
      )}
      {/* optional icon if type is neutral */}
      {type === 'neutral' && iconName && (
        <Icon iconName={iconName} titleText="Loren Ipsum" />
      )}
      {content || (
        <div id={notificationLabelId} className="a-notification__content">
          {children || (
            <>
              At vero eos et accusam et justo duo dolores et ea rebum. Stet
              clita kasd gubergren, no sea{' '}
              <Link level="inline" label="Link sanctus" href="/" /> est Lorem
              ipsum dolor sit amet. At vero eos et accusam et justo duo dolores
              et ea rebum. Stet clita kasd gubergren, lorem ipsum dolor sit amet
            </>
          )}
        </div>
      )}
      {variant === 'banner' && (
        <Button
          action="close"
          mode="integrated"
          icon="close"
          isUiIcon
          aria-label="close banner"
        />
      )}
    </div>
  );
};

export { Notification };
export type { NotificationProps };
