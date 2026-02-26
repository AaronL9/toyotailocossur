export function getFormValues(form: HTMLFormElement): unknown {
  const formData = new FormData(form);
  return Object.fromEntries(formData.entries());
}