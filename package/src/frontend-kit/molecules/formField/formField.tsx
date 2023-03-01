import * as React from 'react';
import { Checkbox } from '../../atoms/checkbox/checkbox';
import { Dropdown, OptionProps } from '../../atoms/dropdown/dropdown';
import { Notification } from '../../atoms/notification/notification';
import { RadioButton } from '../../atoms/radioButton/radioButton';
import { TextArea } from '../../atoms/textArea/textArea';
import { TextField } from '../../atoms/textField/textField';
import { Toggle } from '../../atoms/toggle/toggle';

interface FormFieldProps {
  fieldType:
    | 'text'
    | 'password'
    | 'textarea'
    | 'radio'
    | 'checkbox'
    | 'dropdown'
    | 'toggle';
  label?: string;
  placeholder?: string;
  id: string;
  size?: 'quarter' | 'half';
  notification?: string;
  state?: 'success' | 'warning' | 'error';
  inputName?: string;
  options?: OptionProps[];
  rightLabel?: string;
}

const FormField: React.FunctionComponent<FormFieldProps> = ({
  fieldType = 'text',
  label = null,
  placeholder = null,
  id,
  size,
  notification,
  state,
  inputName,
  options,
  rightLabel,
}) => {
  const fieldClasses = ['m-form-field'];

  if (fieldType === 'radio') {
    fieldClasses.push('m-form-field--radio');
  }

  if (fieldType === 'checkbox') {
    fieldClasses.push('m-form-field--checkbox');
  }

  if (fieldType === 'dropdown') {
    fieldClasses.push('m-form-field--dropdown');
  }

  if (fieldType === 'toggle') {
    fieldClasses.push('m-form-field--toggle');
  }

  if (size) {
    fieldClasses.push(`-${size}`);
  }

  const fieldClass = fieldClasses.join(' ');

  return (
    <div className={fieldClass}>
      {fieldType === 'text' && (
        <TextField label={label} placeholder={placeholder} id={id} />
      )}
      {fieldType === 'password' && (
        <TextField
          label={label}
          placeholder={placeholder}
          id={id}
          type="password"
        />
      )}
      {fieldType === 'textarea' && (
        <TextArea label={label} placeholder={placeholder} id={id} />
      )}
      {fieldType === 'radio' && (
        <RadioButton label={label} id={id} inputName={inputName} />
      )}
      {fieldType === 'checkbox' && <Checkbox labelCheckbox={label} id={id} />}
      {fieldType === 'dropdown' && <Dropdown id={id} options={options} />}
      {fieldType === 'toggle' && <Toggle id={id} rightLabel={rightLabel} />}
      {notification && (
        <Notification variant="text" type={state || 'neutral'}>
          {notification}
        </Notification>
      )}
    </div>
  );
};

export { FormField };
export type { FormFieldProps };
