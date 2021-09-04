import { setTitle } from "../../helpers";

export default ( args, next ) => {
	setTitle( args.url )
	next()
}