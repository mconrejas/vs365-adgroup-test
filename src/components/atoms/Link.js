export default function ({ url, text, className, onClick }) {
    return (<a className={`py-5 text-white ${className ?? ''}`} href={url} onClick={(e) => onClick(e)}>{text}</a>);
}