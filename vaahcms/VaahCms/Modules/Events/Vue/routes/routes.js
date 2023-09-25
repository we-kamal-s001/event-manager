let routes= [];

import dashboard from "./vue-routes-dashboard";
import events from "./vue-routes-events";
import manager from "./vue-routes-managers";

routes = routes.concat(dashboard);
routes = routes.concat(manager);
routes = routes.concat(events);

export default routes;
