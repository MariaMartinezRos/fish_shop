<?php

namespace App\Http\Controllers;

class ErrorController extends Controller
{
    public function showError($statusCode)
    {
        $url = "https://http.fish/{$statusCode}";

        return view('error', ['url' => $url]);
    }

    public function continue()
    {
        return $this->showError(100);
    }

    public function switchingProtocols()
    {
        return $this->showError(101);
    }

    public function processing()
    {
        return $this->showError(102);
    }

    public function earlyHints()
    {
        return $this->showError(103);
    }

    public function ok()
    {
        return $this->showError(200);
    }

    public function created()
    {
        return $this->showError(201);
    }

    public function accepted()
    {
        return $this->showError(202);
    }

    public function nonAuthoritativeInformation()
    {
        return $this->showError(203);
    }

    public function noContent()
    {
        return $this->showError(204);
    }

    public function resetContent()
    {
        return $this->showError(205);
    }

    public function partialContent()
    {
        return $this->showError(206);
    }

    public function multiStatus()
    {
        return $this->showError(207);
    }

    public function alreadyReported()
    {
        return $this->showError(208);
    }

    public function imUsed()
    {
        return $this->showError(226);
    }

    public function multipleChoices()
    {
        return $this->showError(300);
    }

    public function movedPermanently()
    {
        return $this->showError(301);
    }

    public function found()
    {
        return $this->showError(302);
    }

    public function seeOther()
    {
        return $this->showError(303);
    }

    public function notModified()
    {
        return $this->showError(304);
    }

    public function useProxy()
    {
        return $this->showError(305);
    }

    public function unused()
    {
        return $this->showError(306);
    }

    public function temporaryRedirect()
    {
        return $this->showError(307);
    }

    public function permanentRedirect()
    {
        return $this->showError(308);
    }

    public function badRequest()
    {
        return $this->showError(400);
    }

    public function unauthorized()
    {
        return $this->showError(401);
    }

    public function paymentRequired()
    {
        return $this->showError(402);
    }

    public function forbidden()
    {
        return $this->showError(403);
    }

    public function notFound()
    {
        return $this->showError(404);
    }

    public function methodNotAllowed()
    {
        return $this->showError(405);
    }

    public function notAcceptable()
    {
        return $this->showError(406);
    }

    public function proxyAuthenticationRequired()
    {
        return $this->showError(407);
    }

    public function requestTimeout()
    {
        return $this->showError(408);
    }

    public function conflict()
    {
        return $this->showError(409);
    }

    public function gone()
    {
        return $this->showError(410);
    }

    public function lengthRequired()
    {
        return $this->showError(411);
    }

    public function preconditionFailed()
    {
        return $this->showError(412);
    }

    public function payloadTooLarge()
    {
        return $this->showError(413);
    }

    public function uriTooLong()
    {
        return $this->showError(414);
    }

    public function unsupportedMediaType()
    {
        return $this->showError(415);
    }

    public function rangeNotSatisfiable()
    {
        return $this->showError(416);
    }

    public function expectationFailed()
    {
        return $this->showError(417);
    }

    public function imATeapot()
    {
        return $this->showError(418);
    }

    public function misdirectedRequest()
    {
        return $this->showError(421);
    }

    public function unprocessableEntity()
    {
        return $this->showError(422);
    }

    public function locked()
    {
        return $this->showError(423);
    }

    public function failedDependency()
    {
        return $this->showError(424);
    }

    public function tooEarly()
    {
        return $this->showError(425);
    }

    public function upgradeRequired()
    {
        return $this->showError(426);
    }

    public function preconditionRequired()
    {
        return $this->showError(428);
    }

    public function tooManyRequests()
    {
        return $this->showError(429);
    }

    public function requestHeaderFieldsTooLarge()
    {
        return $this->showError(431);
    }

    public function unavailableForLegalReasons()
    {
        return $this->showError(451);
    }

    public function internalServerError()
    {
        return $this->showError(500);
    }

    public function notImplemented()
    {
        return $this->showError(501);
    }

    public function badGateway()
    {
        return $this->showError(502);
    }

    public function serviceUnavailable()
    {
        return $this->showError(503);
    }

    public function gatewayTimeout()
    {
        return $this->showError(504);
    }

    public function httpVersionNotSupported()
    {
        return $this->showError(505);
    }

    public function variantAlsoNegotiates()
    {
        return $this->showError(506);
    }

    public function insufficientStorage()
    {
        return $this->showError(507);
    }

    public function loopDetected()
    {
        return $this->showError(508);
    }

    public function notExtended()
    {
        return $this->showError(510);
    }

    public function networkAuthenticationRequired()
    {
        return $this->showError(511);
    }
}
