import { setLoadingState } from "../../helpers";

export default ( args, next ) => {
	setLoadingState( true )
	next()
}