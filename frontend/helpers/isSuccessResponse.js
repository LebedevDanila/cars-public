export const isSuccessResponse = (response, isHook = false) => {
  return isHook
    ? response.error?.value === null &&
        response.data.value?.status === 'success'
    : response?.status === 'success'
}
