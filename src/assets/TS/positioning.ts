export function getPositionHeight(
  positionClass: string,
  ovalDivCount: number,
  windowHeight: number
): number {
  const position = parseInt(positionClass.slice(9, 10));
  const maxPosition = Math.floor((windowHeight - 100) / 100) + 1;
  const middlePosition = Math.ceil(maxPosition / 2);
  const baseHeight = (middlePosition - 1) * 100;
  if (position <= middlePosition) {
    return baseHeight + (position - 1) * 100;
  } else {
    return baseHeight + (position - middlePosition) * 100;
  }
}
