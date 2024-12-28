export default function MyLabel({
    labelFor,
    children
}) {
    return <label htmlFor={labelFor}>{children}</label>
}
