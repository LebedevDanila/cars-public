export const getResponseData = (response, isHook = false) => {
  return isHook ? response.data.value?.data : response.data
}
