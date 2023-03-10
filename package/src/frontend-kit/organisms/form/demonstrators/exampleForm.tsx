import * as React from 'react';
import { FormField } from '../../../molecules/formField/formField';
import { Button } from '../../../atoms/button/button';
import { Form } from '../form';

const ExampleFormDemonstrator: React.FunctionComponent = () => (
  <Form>
    <h3>Your inquiry</h3>
    <h4>Contact data</h4>

    <FormField fieldType="text" id="firstName" label="First name *" />

    <FormField fieldType="text" id="lastName" label="Last name *" />

    <div className="o-form__row">
      <FormField fieldType="text" id="street" label="Street" />
      <FormField fieldType="text" id="nr" label="No" size="quarter" />
    </div>

    <div className="o-form__row">
      <FormField fieldType="text" id="zip" label="Zip code" size="half" />
      <FormField fieldType="text" id="city" label="City" size="half" />
    </div>
    <FormField fieldType="text" id="country" label="Country" />
    <FormField fieldType="text" id="email" label="E-Mail address *" />

    <h4>Personal password</h4>
    <FormField fieldType="password" id="password" label="Password *" />
    <FormField
      fieldType="password"
      id="repeatPasword"
      label="Repeat password *"
    />

    <h4>Asking something</h4>
    <p>
      Paragraph Text View standard regular Lorem ipsum dolor sit sadipscing
      elitr?
    </p>
    <FormField
      fieldType="radio"
      inputName="radioSelect"
      id="1stopt"
      label="First option"
    />
    <FormField
      fieldType="radio"
      inputName="radioSelect"
      id="2ndopt"
      label="Second option"
    />
    <FormField
      fieldType="radio"
      inputName="radioSelect"
      id="3rdopt"
      label="Third option"
    />

    <h4>Space for your remarks</h4>
    <FormField fieldType="textarea" id="poem" label="Your poem" />

    <h4>Data protection</h4>
    <p>
      Paragraph Text View standard regular Lorem ipsum dolor sit sadipscing
      elitr?
    </p>
    <FormField fieldType="checkbox" id="agree" label="I agree *" />

    <Button type="submit" action="submit" label="Submit form" />
    <p className="-size-s"> Required fields *</p>
  </Form>
);

export default ExampleFormDemonstrator;
