import * as React from 'react';

import classNames from 'classnames';

import { Box } from '../../atoms/box/box';
import { Button } from '../../atoms/button/button';
import { Divider } from '../../atoms/divider/divider';
import { Icon } from '../../atoms/icon/icon';

import DialogComponent from './index';

class DialogProps {
  // title of the dialog window
  title?: string;
  // variant identifier,
  variant?: 'info' | 'success' | 'warning' | 'error';
  // a page-unique identifier
  dialogId?: string;
  // if true, show as modal
  modal?: boolean;
  // if true, show a close button,
  closeBtn?: boolean;
  // The headline of the dialog box content
  headline?: string;
  // The content of the dialog box
  dialogBody?: string;
  // The error code of the dialog box
  dialogCode?: string;
  // If set to true a third optional button will be displayed
  optionalButton?: boolean;
}

const Dialog: React.FunctionComponent<DialogProps> = ({
  title,
  variant,
  modal,
  dialogId,
  closeBtn,
  headline,
  dialogBody = 'Paragraph text with style text M. Invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et jus to duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.',
  dialogCode,
  optionalButton,
}) => {
  const prefixedDialogId = DialogComponent.dialogId(dialogId);
  const dialogTitleId = `${prefixedDialogId}-title`;
  const dialogDescriptionId = `${prefixedDialogId}-description`;

  const dialogClasses = classNames([
    'm-dialog',
    { [`m-dialog--${variant}`]: variant },
  ]);

  return (
    <div
      className={dialogClasses}
      id={prefixedDialogId}
      role="dialog"
      aria-labelledby={dialogTitleId}
    >
      <Box modal={modal} modalId={`modal-for-${prefixedDialogId}`}>
        {title && (
          <>
            {variant && <div className={`m-dialog__remark --${variant}`} />}
            <div className="m-dialog__header">
              {variant && (
                <Icon
                  iconName={`alert-${variant}`}
                  isUiIcon
                  titleText={variant}
                />
              )}
              <div className="m-dialog__title">{title}</div>
              {closeBtn && (
                <Button
                  action="close"
                  mode="integrated"
                  icon="close"
                  isUiIcon
                  aria-label="close dialog"
                />
              )}
            </div>
            <Divider />
          </>
        )}
        <div className="m-dialog__content">
          {headline && (
            <div className="m-dialog__headline" id={dialogTitleId}>
              {headline}
            </div>
          )}
          <div className="m-dialog__body" id={dialogDescriptionId}>
            {dialogBody}
          </div>
          {dialogCode && <div className="m-dialog__code">{dialogCode}</div>}
          <div className="m-dialog__actions">
            {optionalButton && (
              <Button
                label="Optional button"
                mode="secondary"
                action="optional"
              />
            )}
            <Button label="Confirm" mode="primary" action="confirm" />
            <Button label="Cancel" mode="secondary" action="cancel" />
          </div>
        </div>
      </Box>
    </div>
  );
};

export { Dialog, DialogProps };
