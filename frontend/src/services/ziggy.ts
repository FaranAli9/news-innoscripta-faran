import { route, Config } from 'ziggy-js'

const routes: Config = {
    "url": "http://localhost", "port": null, "defaults": {}, "routes": {
        "auth.register": {"uri": "api/auth/register", "methods": ["POST"]},
        "auth.login": {"uri": "api/auth/login", "methods": ["POST"]},
        "auth.profile.get": {"uri": "api/auth/profile", "methods": ["GET", "HEAD"]},
        "auth.profile.update": {"uri": "api/auth/profile", "methods": ["POST"]},
        "feed.index": {"uri": "api/feed", "methods": ["GET", "HEAD"]},
        "feed.preferences.get": {"uri": "api/feed/preferences", "methods": ["GET", "HEAD"]},
        "feed.preferences.update": {"uri": "api/feed/preferences", "methods": ["POST"]},
        "lookups.categories": {"uri": "api/lookups/categories", "methods": ["GET", "HEAD"]},
        "lookups.sources": {"uri": "api/lookups/sources", "methods": ["GET", "HEAD"]},
        "lookups.authors": {"uri": "api/lookups/authors", "methods": ["GET", "HEAD"]}
    }
}
export const ziggy = (name: string, params = {}) => route(name, params, true, routes)