exports.roundDisplay = (value) => {
  if (value < 0) {
    return 0
  } else {
    return value.toFixed(2)
  }
}
