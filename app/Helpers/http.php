<?php

/*
 * Global helper functions for HTTP.
 */

/**
 * Return this response to return a simple page saying just "ok", with status 200 and in text/plain.
 *
 * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
 */
function ok()
{
    return response('ok', 200, ['Content-Type' => 'text/plain']);
}
