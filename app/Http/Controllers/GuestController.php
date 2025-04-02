<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGuestRequest;
use App\Http\Requests\UpdateGuestRequest;
use App\Http\Resources\GuestResource;
use App\Models\Guest;
use App\Repositories\Contracts\GuestRepositoryInterface;
use App\Services\GuestService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class GuestController extends Controller
{
    public function __construct(
        private readonly GuestService $guestService,
        private readonly GuestRepositoryInterface $guestRepository
    ) {
    }

    /**
     * @OA\Get(
     *     path="/api/guest",
     *     tags={"guest"},
     *     summary="Get all guests",
     *
     *     @OA\Response(
     *         response=200,
     *         description="Guests data",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                  property="data",
     *                  type="object",
     *                  ref="#/components/schemas/GuestResource"
     *              )
     *          ),
     *     ),
     *
     * )
     */

    public function index(): AnonymousResourceCollection
    {
        return GuestResource::collection($this->guestRepository->getAll());
    }

    /**
     * @OA\Get(
     *     path="/api/guest/{id}",
     *     tags={"guest"},
     *     summary="Get Guest by id",
     *     @OA\Parameter(
     *          name="id",
     *          in="path",
     *          required=true,
     *          description="guest id",
     *          @OA\Schema(
     *              type="integer",
     *              format="int64",
     *              example=1
     *          )
     *      ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Guest data",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                  property="data",
     *                  type="object",
     *                  ref="#/components/schemas/GuestResource"
     *              )
     *          ),
     *     ),
     *
     *     @OA\Response(
     *          response=404,
     *          description="Guest not found",
     *      ),
     * )
     */
    public function show(int $id): GuestResource
    {
        return GuestResource::make($this->guestRepository->getByIdOrFail($id));
    }

    /**
     * @OA\Post(
     *     path="/api/guest",
     *     tags={"guest"},
     *     summary="Store new guest",
     *     @OA\RequestBody(ref="#/components/requestBodies/StoreGuestRequest"),
     *
     *     @OA\Response(
     *         response=201,
     *         description="guest created",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                  property="data",
     *                  type="object",
     *                  ref="#/components/schemas/GuestResource"
     *              )
     *          ),
     *     ),
     *       @OA\Response(
     *          response="422",
     *          description="Validation Error",
     *       ),
     *
     * )
     */
    public function store(StoreGuestRequest $request): GuestResource
    {
        return GuestResource::make($this->guestService->store($request->validated()));
    }

    /**
     * @OA\Put(
     *     path="/api/guest/{id}",
     *     tags={"guest"},
     *     summary="Update Guest",
     *          @OA\Parameter(
     *           name="id",
     *           in="path",
     *           required=true,
     *           description="guest id",
     *           @OA\Schema(
     *               type="integer",
     *               format="int64",
     *               example=1
     *           )
     *       ),
     *     @OA\RequestBody(ref="#/components/requestBodies/UpdateGuestRequest"),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Guest updated successfully",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="data",
     *                 type="object",
     *                 ref="#/components/schemas/GuestResource"
     *              )
     *          ),
     *     ),
     *      @OA\Response(
     *          response="422",
     *          description="Validation Error",
     *      ),
     * )
     */
    public function update(UpdateGuestRequest $request, int $id): GuestResource
    {
        $guest = Guest::findOrFail($id);

        return GuestResource::make($this->guestService->update($request->validated(), $guest));
    }

    public function destroy(int $id): bool
    {
        $guest = Guest::findOrFail($id);

        return $this->guestService->destroy($guest);
    }
}
