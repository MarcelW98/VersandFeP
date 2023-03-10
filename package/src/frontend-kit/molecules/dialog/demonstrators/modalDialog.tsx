import * as React from 'react';
import { Dialog } from '../dialog';
import { Button } from '../../../atoms/button/button';

interface ModalDialogProps {
  dialogId: string;
}

const ModalDialog: React.FunctionComponent<ModalDialogProps> = ({
  dialogId,
}) => (
  <div
    className="frontend-kit-example_modal-dialog"
    data-frok-show-dialog={dialogId}
  >
    <Button label="click here" />
    <Dialog modal title="Info" dialogId={dialogId} closeBtn />
  </div>
);

export default ModalDialog;
