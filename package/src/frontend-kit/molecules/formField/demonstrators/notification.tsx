import * as React from 'react';
import { Button } from '../../../atoms/button/button';
import { Divider } from '../../../atoms/divider/divider';
import { FormField, FormFieldProps } from '../formField';

const NotificationFormFieldDemonstrator: React.FunctionComponent<FormFieldProps> = ({
  fieldType = 'text',
  id,
  label = null,
  placeholder = null,
  size,
  inputName,
  options,
  rightLabel,
}) => (
  <div className="frontend-kit-example_form-field-notification">
    <Button label="Error" action="error" />
    <Button label="Warning" action="warning" />
    <Button label="Success" action="success" />
    <Button label="Neutral" action="neutral" />
    <Button label="Reset" action="reset" mode="secondary" />
    <Divider />
    <FormField
      id={id}
      fieldType={fieldType}
      label={label}
      placeholder={placeholder}
      size={size}
      inputName={inputName}
      options={options}
      rightLabel={rightLabel}
    />
    <style
      dangerouslySetInnerHTML={{
        __html:
          '.frontend-kit-example_form-field-notification .a-button { margin-right: 12px; display: inline-block; }',
      }}
    />
  </div>
);

export default NotificationFormFieldDemonstrator;
