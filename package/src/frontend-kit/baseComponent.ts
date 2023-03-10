import ElementWithComponent from './ElementWithComponent';

interface ConstructorWithEvents extends Function {
  events?: string[];
}

/**
 * function to check if the requested event can be bound to the component
 */
const throwIfEventUnknown = (
  constructorFunction: ConstructorWithEvents,
  eventName: string,
): void => {
  if (!constructorFunction.events.includes(eventName)) {
    throw new Error(
      `Unknown event ${eventName} in component ${constructorFunction.name}.`,
    );
  }
};

/**
 * @name    base-component
 * @author Experience One AG
 * @copyright Robert Bosch GmbH
 * @description
 * this base class is the foundation for all vanilla.js component implementations
 * it provides the basic functions we need in each component
 * 1. an event-registry
 * 2. addEventListener Method
 * 3. removeEventListener Method
 * 4. check if the event is available for the component
 * 5. trigger for the given events
 */
export default class BaseComponent {
  protected container: HTMLElement;
  protected alreadyInitialized = false;

  constructor(container: HTMLElement) {
    /**
     * store the HTML element
     */
    this.container = container;

    const constructorFunction = this.constructor as ConstructorWithEvents;

    /**
     * set all registry entries to empty arrays so we don't have to do that later
     */
    if (constructorFunction.events) {
      constructorFunction.events.forEach((eventName) => {
        this.eventRegistry[eventName] = [];
      });
    }

    if ((container as ElementWithComponent).component) {
      this.alreadyInitialized = true;
      return;
    }

    /**
     * set the component property to return this instance
     * can be used to use the API from outside of this codebase
     */
    Object.defineProperty(container, 'component', {
      get: () => this,
    });
  }

  /**
   * a registry for custom events and their callbacks
   */
  protected eventRegistry: {
    [eventName: string]: Function[];
  } = {};

  /**
   * adds a callback for the given event
   * @return a unsubscribe function to remove the listener
   */
  public addEventListener = (
    eventName: string,
    callback: Function,
  ): Function => {
    throwIfEventUnknown(this.constructor as ConstructorWithEvents, eventName);
    const callbackIndex = this.eventRegistry[eventName].push(callback) - 1;

    return (): void => {
      this.eventRegistry[eventName][callbackIndex] = null;
    };
  };

  /**
   * removes all instances of a listener by reference
   * can be used if the unsubscribe cannot be kept when using addEventListener
   */
  public removeEventListener = (
    eventName: string,
    callbackReference: Function,
  ): void => {
    throwIfEventUnknown(this.constructor as ConstructorWithEvents, eventName);

    this.eventRegistry[eventName] = this.eventRegistry[
      eventName
    ].map((callback) => (callback === callbackReference ? null : callback));
  };

  /**
   * triggers a given event with the parameters given, if any
   */
  protected triggerEvent = (
    eventName: string,
    // unfortunately, we cannot TS-specify the types and amount of parameters passed here :/
    /* eslint-disable-next-line @typescript-eslint/no-explicit-any */
    ...params: any[]
  ): void => {
    (this.eventRegistry[eventName] || []).forEach((callback) => {
      if (typeof callback === 'function') {
        callback(...params);
      }
    });
  };
}
