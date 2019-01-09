<?php
/**
 * @license S4FE
 */

/**
 * @OA\SecurityScheme(
 *   securityScheme="Bearer",
 *   type="apiKey",
 *   in="header",
 *   name="Autorization"
 * )
 */

/**
 * @OA\Info(
 *     description="SAFE REST API.  You can findout more about S4FE at [WEB APP](https://s4febeta.testingdevelopmentprocess.com)",
 *     version="2.0.0",
 *     title="SAFE REST API",
 *     termsOfService="/api/docs/termsOfService",
 *     @OA\Contact(
 *         email="no_reply@s4fe.io"
 *     ),
 *     @OA\License(
 *         name="License Apache 2.0",
 *         url="http://www.apache.org/licenses/LICENSE-2.0.html"
 *     )
 * )
 */

/**
 * @OA\Server(
 *     description="S4FEAPI local server",
 *     url="http://s4fe-api.local"
 * )
 * 
 * @OA\Server(
 *     description="S4FEAPI Prod server",
 *     url="https://betaapi.s4fe.io"
 * )
 *
 * @OA\Server(
 *     description="S4FEAPI Dev server",
 *     url="https://s4febetaapi.testingdevelopmentprocess.com"
 * )
 */

/**
 * @OA\Tag(
 *     name="Auth",
 *     description="Auth services",
 *     @OA\ExternalDocumentation(
 *         description="Find out more about Auth",
 *         url="/api/docs/auth"
 *     )
 * )
 */

/**
 * @OA\Tag(
 *     name="User",
 *     description="User services",
 *     @OA\ExternalDocumentation(
 *         description="Find out more about User",
 *         url="/api/docs/user"
 *     )
 * )
 */

/**
 * @OA\Tag(
 *     name="Items",
 *     description="Item services",
 *     @OA\ExternalDocumentation(
 *         description="Find out more about Items",
 *         url="/api/docs/items"
 *     )
 * )
 */

/**
 * @OA\Tag(
 *     name="Reports",
 *     description="Report services",
 *     @OA\ExternalDocumentation(
 *         description="Find out more about Reports",
 *         url="/api/docs/items_reports"
 *     )
 * )
 */

/**
 * @OA\Tag(
 *     name="ReportComments",
 *     description="Report Comment services",
 *     @OA\ExternalDocumentation(
 *         description="Find out more about Report Comments",
 *         url="/api/docs/report_comments"
 *     )
 * )
 */

/**
 * @OA\Tag(
 *     name="Search",
 *     description="Search services",
 *     @OA\ExternalDocumentation(
 *         description="Find out more about Search",
 *         url="/api/docs/search"
 *     )
 * )
 */

/**
 * @OA\Tag(
 *     name="Category",
 *     description="Category services",
 *     @OA\ExternalDocumentation(
 *         description="Find out more about Category",
 *         url="/api/docs/category"
 *     )
 * )
 */

/**
 * @OA\Schema(
 *   schema="User",
 *   type="object",
 *   title="User",
 *   description="User Model",
 *   @OA\Property(
 *       property="id",
 *       type="integer"
 *   ),
 *   @OA\Property(
 *       property="uuid",
 *       type="string"
 *   ),
 *   @OA\Property(
 *       property="item_report_banned",
 *       type="integer"
 *   ),
 *   @OA\Property(
 *       property="first_name",
 *       type="string"
 *   ),
 *   @OA\Property(
 *       property="last_name",
 *       type="string"
 *   ),
 *   @OA\Property(
 *       property="middle_name",
 *       type="string"
 *   ),
 *   @OA\Property(
 *       property="display_name",
 *       type="string"
 *   ),
 *   @OA\Property(
 *       property="nationality",
 *       type="string"
 *   ),
 *   @OA\Property(
 *       property="phone",
 *       type="string"
 *   ),
 *   @OA\Property(
 *       property="photo",
 *       type="string"
 *   ),
 *   @OA\Property(
 *       property="gender",
 *       type="string",
 *       default="male",
 *       enum={"male", "female"}
 *   ),
 *   @OA\Property(
 *       property="birth_date",
 *       type="string"
 *   ),
 *   @OA\Property(
 *       property="email",
 *       type="string"
 *   ),
 *   @OA\Property(
 *       property="walletAddress",
 *       type="string"
 *   ),
 *   @OA\Property(
 *       property="keystore",
 *       type="string"
 *   ),
 *   @OA\Property(
 *       property="status",
 *       type="object",
 *       allOf={@OA\Schema(ref="#/components/schemas/UserStatus")}
 *   ),
 * )
 */

/**
 * @OA\Schema(
 *   schema="PrivateUser",
 *   type="object",
 *   title="PrivateUser",
 *   description="User with limited data to display.",
 *   @OA\Property(
 *       property="id",
 *       type="integer"
 *   ),
 *   @OA\Property(
 *       property="uuid",
 *       type="string"
 *   ),
 *   @OA\Property(
 *       property="item_report_banned",
 *       type="integer"
 *   ),
 *   @OA\Property(
 *       property="first_name",
 *       type="string"
 *   ),
 *   @OA\Property(
 *       property="last_name",
 *       type="string"
 *   ),
 *   @OA\Property(
 *       property="display_name",
 *       type="string"
 *   ),
 * )
 */

/**
 * @OA\Schema(
 *   schema="UserStatus",
 *   type="object",
 *   title="UserStatus",
 *   description="User statuses",
 *   @OA\Property(
 *       property="name",
 *       type="enum",
 *       enum={"pending", "compleaded", "confirmed"},
 *       default="pending"
 *   ),
 * )
 */

/**
 * @OA\Schema(
 *   schema="Category",
 *   type="object",
 *   title="Category",
 *   description="Categories",
 *   @OA\Property(
 *       property="id",
 *       type="integer"
 *   ),
 *   @OA\Property(
 *       property="parent_id",
 *       type="integer"
 *   ),
 *   @OA\Property(
 *       property="name",
 *       type="string"
 *   ),
 * )
 */

/**
 * @OA\Schema(
 *   schema="Item",
 *   type="object",
 *   title="Item",
 *   description="User Items",
 *   @OA\Property(
 *       property="id",
 *       type="integer"
 *   ),
 *   @OA\Property(
 *       property="title",
 *       type="string"
 *   ),
 *   @OA\Property(
 *       property="reward",
 *       type="integer"
 *   ),
 *   @OA\Property(
 *       property="description",
 *       type="string"
 *   ),
 *   @OA\Property(
 *       property="serial_number",
 *       type="string"
 *   ),
 *   @OA\Property(
 *       property="owner",
 *       type="object",
 *       allOf={@OA\Schema(ref="#/components/schemas/PrivateUser")}
 *   ),
 *   @OA\Property(
 *       property="status",
 *       type="object",
 *       allOf={@OA\Schema(ref="#/components/schemas/ItemStatus")}
 *   ),
 *   @OA\Property(
 *       property="category",
 *       type="object",
 *       allOf={@OA\Schema(ref="#/components/schemas/Category")}
 *   ),
 *   @OA\Property(
 *       property="transform_ownership",
 *       type="object",
 *       allOf={@OA\Schema(ref="#/components/schemas/PrivateUser")}
 *   ),
 *   @OA\Property(
 *       property="photos",
 *       type="array",
 *       @OA\items(ref="#/components/schemas/ItemPhotos"))
 *   ),
 * )
 */

/**
 * @OA\Schema(
 *   schema="ItemStatus",
 *   type="object",
 *   title="ItemStatus",
 *   description="Item statuses",
 *   @OA\Property(
 *       property="id",
 *       type="integer",
 *       example=1,
 *   ),
 *   @OA\Property(
 *       property="name",
 *       type="enum",
 *       enum={"stolen", "lost", "available", "aproved"},
 *       default="stolen"
 *   ),
 *   @OA\Property(
 *       property="color",
 *       type="string",
 *       example="#FFFF4E4E"
 *   ),
 * )
 */

/**
 * @OA\Schema(
 *   schema="ItemPhotos",
 *   type="object",
 *   title="ItemPhotos",
 *   description="Item photos",
 *   @OA\Property(
 *       property="id",
 *       type="integer",
 *   ),
 *   @OA\Property(
 *       property="file",
 *       type="string",
 *   ),
 *   @OA\Property(
 *       property="name",
 *       type="string",
 *   ),
 * )
 */

/**
 * @OA\Schema(
 *   schema="ReportPhotos",
 *   type="object",
 *   title="ReportPhotos",
 *   description="Report photos",
 *   @OA\Property(
 *       property="id",
 *       type="integer",
 *       example="1",
 *   ),
 *   @OA\Property(
 *       property="report_id",
 *       type="integer",
 *       example="3",
 *   ),
 *   @OA\Property(
 *       property="file",
 *       type="string",
 *       example="http://base_url/file_path/unique_file_name.jpg",
 *   ),
 *   @OA\Property(
 *       property="name",
 *       type="string",
 *       example="iPhone.png",
 *   ),
 * )
 */

/**
 * @OA\Schema(
 *   schema="Report",
 *   type="object",
 *   title="Report",
 *   description="Item reports",
 *   @OA\Property(
 *       property="id",
 *       type="integer",
 *   ),
 *   @OA\Property(
 *       property="text",
 *       type="string",
 *   ),
 *   @OA\Property(
 *       property="website",
 *       type="string",
 *   ),
 *   @OA\Property(
 *       property="reporter",
 *       type="object",
 *       allOf={@OA\Schema(ref="#/components/schemas/PrivateUser")}
 *   ),
 *   @OA\Property(
 *       property="item",
 *       type="object",
 *       allOf={@OA\Schema(ref="#/components/schemas/Item")}
 *   ),
 *   @OA\Property(
 *       property="status",
 *       type="object",
 *       allOf={@OA\Schema(ref="#/components/schemas/ReportStatus")}
 *   ),
 *   @OA\Property(
 *       property="photos",
 *       type="array",
 *       @OA\Items(ref="#/components/schemas/ReportPhotos")
 *   ),
 * )
 */

/**
 * @OA\Schema(
 *   schema="ReportStatus",
 *   type="object",
 *   title="ReportStatus",
 *   description="Item report status",
 *   @OA\Property(
 *       property="id",
 *       type="integer",
 *   ),
 *   @OA\Property(
 *       property="name",
 *       type="string",
 *       default="pending",
 *       enum={"pending", "approved","rejected","under_review"}
 *   ),
 * )
 */

/**
 * @OA\Schema(
 *   schema="SearchItemsResponce",
 *   type="object",
 *   title="SearchItemsResponce",
 *   allOf={
 *      @OA\Schema(ref="#/components/schemas/Responce2xx"),
 *   },
 *   @OA\Property (
 *        property="data",
 *        type="array",
 *        @OA\Items(
 *            @OA\Property(
 *                property="id",
 *                type="integer",
 *            ),
 *            @OA\Property(
 *                property="title",
 *                type="string"
 *            ),
 *            @OA\Property(
 *                property="serial_number",
 *                type="string"
 *            ),
 *            @OA\Property(
 *                property="description",
 *                type="string"
 *            ),
 *            @OA\Property(
 *                property="reward",
 *                type="string"
 *            ),
 *            @OA\Property(
 *                property="created_date",
 *                type="string"
 *            ),
 *            @OA\Property(
 *                property="photo",
 *                type="string"
 *            ),
 *            @OA\Property(
 *                property="transfer_ownership_id",
 *                type="integer"
 *            ),
 *            @OA\Property(
 *                property="transfer_ownership_email",
 *                type="string"
 *            ),
 *            @OA\Property(
 *                property="transfer_ownership_full_name",
 *                type="string"
 *            ),
 *            @OA\Property(
 *                property="user_id",
 *                type="integer"
 *            ),
 *            @OA\Property(
 *                property="user_email",
 *                type="string"
 *            ),
 *            @OA\Property(
 *                property="user_full_name",
 *                type="string"
 *            ),
 *            @OA\Property(
 *                property="user_address",
 *                type="string"
 *            ),
 *            @OA\Property(
 *                property="status_id",
 *                type="integer"
 *            ),
 *            @OA\Property(
 *                property="status",
 *                type="string"
 *            ),
 *            @OA\Property(
 *                property="category_id",
 *                type="integer"
 *            ),
 *            @OA\Property(
 *                property="category",
 *                type="string"
 *            ),
 *            @OA\Property(
 *                property="subcategory_id",
 *                type="integer"
 *            ),
 *            @OA\Property(
 *                property="subcategory",
 *                type="string"
 *            ),
 *            @OA\Property(
 *                property="coefficient",
 *                type="integer"
 *            ),
 *        ),
 *    )
 * )
 */

/**
 * @OA\Schema(
 *   schema="Responce2xx",
 *   type="object",
 *   title="Responce2xx",
 *   @OA\Property(
 *       property="status",
 *       type="integer",
 *       example="2xx"
 *   ),
 *   @OA\Property(
 *       property="message",
 *       type="string",
 *       example="Some Success Message.",
 *   ),
 * )
 */

/**
 * @OA\Schema(
 *   schema="AuthResponce",
 *   type="object",
 *   title="AuthResponce",
 *   allOf={
 *      @OA\Schema(ref="#/components/schemas/Responce2xx"),
 *   },
 *   @OA\Property(
 *        property="data",
 *        type="object",
 *        @OA\Property(
 *            property="user",
 *            type="object",
 *            allOf={@OA\Schema(ref="#/components/schemas/User")},
 *        ),
 *        @OA\Property(
 *            property="access_token",
 *            type="string"
 *        ),
 *    )
 * )
 */

/**
 * @OA\Schema(
 *   schema="RegisterResponce",
 *   type="object",
 *   title="AuthResponce",
 *   allOf={
 *      @OA\Schema(ref="#/components/schemas/Responce2xx"),
 *   },
 *   @OA\Property(
 *        property="data",
 *        type="object",
 *        @OA\Property(
 *            property="user",
 *            type="object",
 *            allOf={@OA\Schema(ref="#/components/schemas/User")},
 *        ),
 *    )
 * )
 */

/**
 * @OA\Schema(
 *   schema="ItemResponce",
 *   type="object",
 *   title="ItemResponce",
 *   allOf={
 *      @OA\Schema(ref="#/components/schemas/Responce2xx"),
 *   },
 *   @OA\Property(
 *       property="count",
 *       type="integer",
 *       default=0
 *   ),
 *   @OA\Property(
 *       property="total",
 *       type="integer",
 *       default=0
 *   ),
 *   @OA\Property(
 *       property="data",
 *       type="array",
 *       @OA\Items(ref="#/components/schemas/Item")
 *   )
 * )
 */

/**
 * @OA\Schema(
 *   schema="ReportResponce",
 *   type="object",
 *   title="ItemResponce",
 *   allOf={
 *      @OA\Schema(ref="#/components/schemas/Responce2xx"),
 *   },
 *   @OA\Property(
 *       property="count",
 *       type="integer",
 *       example=10
 *   ),
 *   @OA\Property(
 *       property="total",
 *       type="integer",
 *       example=25
 *   ),
 *   @OA\Property(
 *       property="data",
 *       type="array",
 *       @OA\Items(ref="#/components/schemas/Report")
 *   )
 * )
 */

/**
 * @OA\Schema(
 *   schema="Responce307",
 *   type="object",
 *   title="Responce307",
 *   allOf={
 *      @OA\Schema(ref="#/components/schemas/Responce2xx"),
 *   },
 *   @OA\Property(
 *       property="action",
 *       type="string",
 *       example="http://base_url/action-name",
 *   ),
 *   @OA\Property(
 *       property="data",
 *       example={}
 *   ),
 * )
 */

/**
 * @OA\Schema(
 *   schema="Error",
 *   type="object",
 *   title="Error",
 *   @OA\Property(
 *       property="status",
 *       type="integer",
 *       example="Error code"
 *   ),
 *   @OA\Property(
 *       property="message",
 *       type="string",
 *       example="Some Error Message.",
 *   ),
 * )
 */

/**
 * @OA\Schema(
 *   schema="Responce400",
 *   type="object",
 *   title="Responce400",
 *   allOf={
 *      @OA\Schema(ref="#/components/schemas/Error"),
 *   },
 *   @OA\Property(
 *       property="errors",
 *       type="object",
 *       example={"key":{0:"message",1:"message1"},"keyN":{0:"messageN"}},
 *   ),
 * )
 */

/**
 * @OA\Post(
 *     tags={"Auth"},
 *     path="/authenticate",
 *     summary="Oauth2 Authentication. Get user + personal access token.",
 *     @OA\Parameter(
 *       name="Accept",
 *       in="header",
 *       description="Define content type of response",
 *       required=true,
 *       @OA\Schema(
 *          type="object",
 *          example="{}",
 *          @OA\Property(
 *              property="Accept",
 *              type="string",
 *          ),
 *       )
 *     ),
 *     @OA\RequestBody(
 *       required=true,
 *       description="User email and password.",
 *       @OA\MediaType(
 *         mediaType="application/json",
 *         @OA\Schema(
 *           @OA\Property(
 *               property="email",
 *               type="string"
 *           ),
 *           @OA\Property(
 *               property="password",
 *               type="string"
 *           ),
 *           example={"email": "admin@admin.com", "password": "admin@admin.com1"}
 *         )
 *       )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="OK",
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(ref="#/components/schemas/AuthResponce")
 *         )
 *     ),
 *     @OA\Response(
 *         response=307,
 *         description="Temporary Redirect.",
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(ref="#/components/schemas/Responce307")
 *         )
 *     ),
 *     @OA\Response(
 *         response=401,
 *         description="Unauthorized",
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(ref="#/components/schemas/Error")
 *         )
 *     ),
 *     @OA\Response(
 *         response=500,
 *         description="Server Error",
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(ref="#/components/schemas/Error")
 *         )
 *     ),
 * )
 */

/**
 * @OA\Post(
 *     tags={"Auth"},
 *     path="/send-verification-sms",
 *     summary="Send verification sms on phone number",
 *     @OA\Parameter(
 *       name="Accept",
 *       in="header",
 *       description="Define content type of response",
 *       required=true,
 *       @OA\Schema(
 *          type="object",
 *          example="application/json",
 *          @OA\Property(
 *              property="Accept",
 *              type="string",
 *          ),
 *       )
 *     ),
 *     @OA\RequestBody(
 *       required=true,
 *       description="Enter valid phone number",
 *       @OA\MediaType(
 *         mediaType="application/json",
 *         @OA\Schema(
 *           @OA\Property(
 *               property="phone",
 *               type="integer",
 *               example="37494471010",
 *           ),
 *         )
 *       )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="OK",
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(ref="#/components/schemas/AuthResponce")
 *         )
 *     ),
 *     @OA\Response(
 *         response=307,
 *         description="Temporary Redirect.",
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(ref="#/components/schemas/Responce307")
 *         )
 *     ),
 *     @OA\Response(
 *         response=400,
 *         description="Bad Request",
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(ref="#/components/schemas/Responce400")
 *         )
 *     ),
 *     @OA\Response(
 *         response=500,
 *         description="Server Error",
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(ref="#/components/schemas/Error")
 *         )
 *     ),
 * )
 */

/**
 * @OA\Post(
 *     tags={"Auth"},
 *     path="/register",
 *     summary="Create user and send verification email",
 *     @OA\Parameter(
 *       name="Accept",
 *       in="header",
 *       description="Define content type of response",
 *       required=true,
 *       @OA\Schema(
 *          type="object",
 *          example="{}",
 *          @OA\Property(
 *              property="Accept",
 *              type="string",
 *          ),
 *       )
 *     ),
 *     @OA\RequestBody(
 *       required=true,
 *       description="Enter User email and verified phone number",
 *       @OA\MediaType(
 *         mediaType="application/json",
 *         @OA\Schema(
 *           @OA\Property(
 *               property="email",
 *               type="string",
 *               example="admin@admin.com",
 *           ),
 *           @OA\Property(
 *               property="phone",
 *               type="integer",
 *               example="37494555555",
 *           ),
 *         )
 *       )
 *     ),
 *     @OA\Response(
 *         response=201,
 *         description="Created.",
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(ref="#/components/schemas/RegisterResponce")
 *         )
 *     ),
 *     @OA\Response(
 *         response=400,
 *         description="Bad Request",
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(ref="#/components/schemas/Responce400")
 *         )
 *     ),
 *     @OA\Response(
 *         response=403,
 *         description="Forbidden.",
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(ref="#/components/schemas/Error")
 *         )
 *     ),
 *     @OA\Response(
 *         response=500,
 *         description="Server Error.",
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(ref="#/components/schemas/Error")
 *         )
 *     )
 * )
 */

/**
 * @OA\Post(
 *     tags={"Auth"},
 *     path="/user/password",
 *     summary="Set password by verified email or phone",
 *     @OA\Parameter(
 *       name="Accept",
 *       in="header",
 *       description="Define content type of response",
 *       required=true,
 *       @OA\Schema(
 *          type="object",
 *          example="{}",
 *          @OA\Property(
 *              property="Accept",
 *              type="string",
 *          ),
 *       )
 *     ),
 *     @OA\RequestBody(
 *       required=true,
 *       description="Enter User (email or verified phone number) + (password and password_confirmation)",
 *       @OA\MediaType(
 *         mediaType="application/json",
 *         @OA\Schema(
 *           @OA\Property(
 *               property="email",
 *               type="string",
 *               example="admin@admin.com(optional if the phone is set)",
 *           ),
 *           @OA\Property(
 *               property="phone",
 *               type="integer",
 *               example="37494555555(optional if the email is set)",
 *           ),
 *           @OA\Property(
 *               property="password",
 *               type="string",
 *               example="admin@admin.com1",
 *           ),
 *           @OA\Property(
 *               property="password_confirmation",
 *               type="string",
 *               example="admin@admin.com1",
 *           ),
 *         )
 *       )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="OK",
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(ref="#/components/schemas/RegisterResponce")
 *         )
 *     ),
 *     @OA\Response(
 *         response=400,
 *         description="Bad Request",
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(ref="#/components/schemas/Responce400")
 *         )
 *     ),
 *     @OA\Response(
 *         response=403,
 *         description="Forbidden.",
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(ref="#/components/schemas/Error")
 *         )
 *     ),
 *     @OA\Response(
 *         response=500,
 *         description="Server Error.",
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(ref="#/components/schemas/Error")
 *         )
 *     )
 * )
 */

/**
 * @OA\Post(
 *     tags={"Auth"},
 *     path="/signup-forward/{email}",
 *     summary="Forward email to complete registration.",
 *     @OA\Parameter(
 *       name="Accept",
 *       in="header",
 *       description="Define content type of response",
 *       required=true,
 *       @OA\Schema(
 *          type="object",
 *          example="{}",
 *          @OA\Property(
 *              property="Accept",
 *              type="string",
 *          ),
 *       )
 *     ),
 *     @OA\Parameter(
 *       name="Authorization",
 *       in="header",
 *       description="Bearer {access_token}",
 *       required=true,
 *       @OA\Schema(
 *          type="object",
 *          example="Bearer replace_with_access_token",
 *          @OA\Property(
 *              property="Authorization",
 *              type="string",
 *          ),
 *       )
 *     ),
 *     @OA\Parameter(
 *       name="email",
 *       in="path",
 *       description="Not compleated user email",
 *       required=true,
 *       @OA\Schema(
 *          type="string",
 *          example="admin@admin.com",
 *          @OA\Property(
 *              property="email",
 *              type="string",
 *          ),
 *       )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="OK",
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(ref="#/components/schemas/Responce2xx")
 *         )
 *     ),
 *     @OA\Response(
 *         response=400,
 *         description="Bad Request.",
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(ref="#/components/schemas/Responce400")
 *         )
 *     ),
 *     @OA\Response(
 *         response=401,
 *         description="Unauthorized.",
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(ref="#/components/schemas/Error")
 *         )
 *     ),
 *     @OA\Response(
 *         response=403,
 *         description="Forbidden.",
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(ref="#/components/schemas/Error")
 *         )
 *     ),
 *     @OA\Response(
 *         response=500,
 *         description="Server Error.",
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(ref="#/components/schemas/Error")
 *         )
 *     )
 * )
 */

/**
 * @OA\Get(
 *     tags={"Auth"},
 *     path="/user/email/verify/{hash}",
 *     summary="Identify Not-Completed Sign up User process By Hesh",
 *     @OA\Parameter(
 *       name="Accept",
 *       in="header",
 *       description="Define content type of response",
 *       required=true,
 *       @OA\Schema(
 *          type="object",
 *          example="{}",
 *          @OA\Property(
 *              property="Accept",
 *              type="string",
 *          ),
 *       )
 *     ),
 *     @OA\Parameter(
 *       name="hash",
 *       in="path",
 *       description="Hash for completing signup process",
 *       required=true,
 *       @OA\Schema(
 *          type="string"
 *       )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="OK",
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(ref="#/components/schemas/RegisterResponce")
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Not found",
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(ref="#/components/schemas/Error")
 *         )
 *     ),
 *     @OA\Response(
 *         response=500,
 *         description="Server Error.",
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(ref="#/components/schemas/Error")
 *         )
 *     )
 * )
 */

/**
 * @OA\Get(
 *     tags={"Auth"},
 *     path="/phone/verify/{hash}",
 *     summary="Verifying phone number by hash.",
 *     @OA\Parameter(
 *       name="Accept",
 *       in="header",
 *       description="Define content type of response",
 *       required=true,
 *       @OA\Schema(
 *          type="object",
 *          example="application.json",
 *          @OA\Property(
 *              property="Accept",
 *              type="string",
 *          ),
 *       )
 *     ),
 *     @OA\Parameter(
 *       name="hash",
 *       in="path",
 *       description="Hash for verifying phone number",
 *       required=true,
 *       @OA\Schema(
 *          type="string"
 *       )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="OK",
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(ref="#/components/schemas/Responce2xx")
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Not found",
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(ref="#/components/schemas/Error")
 *         )
 *     ),
 *     @OA\Response(
 *         response=500,
 *         description="Server Error.",
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(ref="#/components/schemas/Error")
 *         )
 *     )
 * )
 */

/**
 * @OA\Post(
 *     tags={"Auth"},
 *     path="/reset-password",
 *     summary="Send verification email for resetting password.",
 *     @OA\Parameter(
 *       name="Accept",
 *       in="header",
 *       description="Define content type of response",
 *       required=true,
 *       @OA\Schema(
 *          type="object",
 *          example="{}",
 *          @OA\Property(
 *              property="Accept",
 *              type="string",
 *          ),
 *       )
 *     ),
 *     @OA\RequestBody(
 *       required=true,
 *       description="Enter User email",
 *       @OA\MediaType(
 *         mediaType="application/json",
 *         @OA\Schema(
 *           @OA\Property(
 *               property="email",
 *               type="string"
 *           ),
 *           example={"email": "admin@admin.com"}
 *         )
 *       )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="OK",
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(ref="#/components/schemas/Responce2xx")
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Not Found.",
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(ref="#/components/schemas/Error")
 *         )
 *     ),
 *     @OA\Response(
 *         response=500,
 *         description="Server Error.",
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(ref="#/components/schemas/Error")
 *         )
 *     )
 * )
 */

/**
 * @OA\Get(
 *     tags={"Auth"},
 *     path="/user/reset-password-by-hash/{hash}",
 *     summary="Reset Password By Hesh",
 *     @OA\Parameter(
 *       name="Accept",
 *       in="header",
 *       description="Define content type of response",
 *       required=true,
 *       @OA\Schema(
 *          type="object",
 *          example="{}",
 *          @OA\Property(
 *              property="Accept",
 *              type="string",
 *          ),
 *       )
 *     ),
 *     @OA\Parameter(
 *       name="hash",
 *       in="path",
 *       description="Hash for resetting password.",
 *       required=true,
 *       @OA\Schema(
 *          type="string"
 *       )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="OK",
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(ref="#/components/schemas/AuthResponce")
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Not found",
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(ref="#/components/schemas/Error")
 *         )
 *     ),
 *     @OA\Response(
 *         response=500,
 *         description="Server Error.",
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(ref="#/components/schemas/Error")
 *         )
 *     )
 * )
 */

/**
 * @OA\Post(
 *     tags={"User"},
 *     path="/me",
 *     summary="Get auth user data",
 *     @OA\Parameter(
 *       name="Accept",
 *       in="header",
 *       description="Define content type of response",
 *       required=true,
 *       @OA\Schema(
 *          type="string",
 *          example="application/json",
 *          @OA\Property(
 *              property="Accept",
 *              type="string",
 *          ),
 *       )
 *     ),
 *     @OA\Parameter(
 *       name="Authorization",
 *       in="header",
 *       description="Bearer {access_token}",
 *       required=true,
 *       @OA\Schema(
 *          type="string",
 *          example="Bearer replace_with_access_token",
 *          @OA\Property(
 *              property="Authorization",
 *              type="string",
 *          ),
 *       )
 *     ),
  *    @OA\RequestBody(
 *       required=false,
 *       description="Attach or exclude relations",
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="OK",
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(ref="#/components/schemas/User")
 *         )
 *     ),
 *     @OA\Response(
 *         response=401,
 *         description="Unauthorized.",
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(ref="#/components/schemas/Error")
 *         )
 *     ),
 *     @OA\Response(
 *         response=500,
 *         description="Server Error.",
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(ref="#/components/schemas/Error")
 *         )
 *     )
 * )
 */

/**
 * @OA\Post(
 *     tags={"User"},
 *     path="/user",
 *     summary="Update auth user data",
 *     @OA\Parameter(
 *       name="Accept",
 *       in="header",
 *       description="Define content type of response",
 *       required=true,
 *       @OA\Schema(
 *          type="string",
 *          example="application/json",
 *          @OA\Property(
 *              property="Accept",
 *              type="string",
 *              example="application/json",
 *          ),
 *       )
 *     ),
 *     @OA\Parameter(
 *       name="Authorization",
 *       in="header",
 *       description="Bearer {access_token}",
 *       required=true,
 *       @OA\Schema(
 *          type="string",
 *          example="Bearer replace_with_access_token",
 *          @OA\Property(
 *              property="Authorization",
 *              type="string",
 *          ),
 *       )
 *     ),
  *    @OA\RequestBody(
 *       required=false,
 *       description="Attach or exclude relations",
 *       @OA\MediaType(
 *         mediaType="multipart/form-data",
 *         @OA\Schema(
 *           @OA\Property(
 *               property="_method",
 *               type="string",
 *               example="put",
 *           ),
 *           @OA\Property(
 *               property="first_name",
 *               type="string"
 *           ),
 *           @OA\Property(
 *               property="last_name",
 *               type="string"
 *           ),
 *           @OA\Property(
 *               property="middle_name",
 *               type="string"
 *           ),
 *           @OA\Property(
 *               property="display_name",
 *               type="string"
 *           ),
 *           @OA\Property(
 *               property="nationality",
 *               type="string"
 *           ),
 *           @OA\Property(
 *               property="birth_date",
 *               type="string"
 *           ),
 *           @OA\Property(
 *               property="phone",
 *               type="string"
 *           ),
 *           @OA\Property(
 *               property="photo",
 *               type="file",
 *               format="file",
 *           ),
 *           @OA\Property(
 *               property="gender",
 *               type="string"
 *           ),
 *         )
 *       )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="OK",
 *         @OA\JsonContent(
 *             allOf={
 *                  @OA\Schema(ref="#/components/schemas/Responce2xx"),
 *                  @OA\Property(
 *                      property="data",
 *                      type="object",
 *                      @OA\Property(
 *                          property="user",
 *                          ref="#/components/schemas/User"
 *                      ),
 *                  ),}
 *         ),
 *     ),
 *     @OA\Response(
 *         response=400,
 *         description="Bad Request.",
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(ref="#/components/schemas/Responce400")
 *         )
 *     ),
 *     @OA\Response(
 *         response=401,
 *         description="Unauthorized.",
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(ref="#/components/schemas/Error")
 *         )
 *     ),
 *     @OA\Response(
 *         response=500,
 *         description="Server Error.",
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(ref="#/components/schemas/Error")
 *         )
 *     )
 * )
 */

/**
 * @OA\Post(
 *     tags={"User"},
 *     path="/users/wallet",
 *     summary="Setup ethereum wallet for user",
 *     @OA\Parameter(
 *       name="Accept",
 *       in="header",
 *       description="Define content type of response",
 *       required=true,
 *       @OA\Schema(
 *          type="object",
 *          example="{}",
 *          @OA\Property(
 *              property="Accept",
 *              type="string",
 *          ),
 *       )
 *     ),
 *     @OA\Parameter(
 *       name="Authorization",
 *       in="header",
 *       description="Bearer {access_token}",
 *       required=true,
 *       @OA\Schema(
 *          type="object",
 *          example="Bearer replace_with_access_token",
 *          @OA\Property(
 *              property="Authorization",
 *              type="string",
 *          ),
 *       )
 *     ),
 *     @OA\RequestBody(
 *       required=true,
 *       description="",
 *       @OA\MediaType(
 *         mediaType="application/json",
 *         @OA\Schema(
 *           @OA\Property(
 *               property="password",
 *               type="string"
 *           ),
 *           example={"password": "SomePasswordForWallet"}
 *         )
 *       )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="OK",
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(ref="#/components/schemas/Responce2xx")
 *         )
 *     ),
 *     @OA\Response(
 *         response=401,
 *         description="Unauthorized.",
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(ref="#/components/schemas/Error")
 *         )
 *     ),
 *     @OA\Response(
 *         response=500,
 *         description="Server Error.",
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(ref="#/components/schemas/Error")
 *         )
 *     )
 * )
 */

/**
 * @OA\Post(
 *     tags={"User"},
 *     path="/users/linkWallet",
 *     summary="Link existing ethereum wallet for user",
 *     @OA\Parameter(
 *       name="Accept",
 *       in="header",
 *       description="Define content type of response",
 *       required=true,
 *       @OA\Schema(
 *          type="object",
 *          example="{}",
 *          @OA\Property(
 *              property="Accept",
 *              type="string",
 *          ),
 *       )
 *     ),
 *     @OA\Parameter(
 *       name="Authorization",
 *       in="header",
 *       description="Bearer {access_token}",
 *       required=true,
 *       @OA\Schema(
 *          type="object",
 *          example="Bearer replace_with_access_token",
 *          @OA\Property(
 *              property="Authorization",
 *              type="string",
 *          ),
 *       )
 *     ),
 *     @OA\RequestBody(
 *       required=true,
 *       description="",
 *       @OA\MediaType(
 *         mediaType="application/json",
 *         @OA\Schema(
 *           @OA\Property(
 *               property="walletAddress",
 *               type="string"
 *           ),
 *           example={"walletAddress": "0x0531402f9c8f80424f7c9b6a324441da0a486822"}
 *         )
 *       )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="OK",
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(ref="#/components/schemas/Responce2xx")
 *         )
 *     ),
 *     @OA\Response(
 *         response=401,
 *         description="Unauthorized.",
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(ref="#/components/schemas/Error")
 *         )
 *     ),
 *     @OA\Response(
 *         response=500,
 *         description="Server Error.",
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(ref="#/components/schemas/Error")
 *         )
 *     )
 * )
 */

/**
 * @OA\Get(
 *     tags={"Items"},
 *     path="/items",
 *     summary="Get Items list",
 *     @OA\Parameter(
 *       name="Accept",
 *       in="header",
 *       description="Define content type of response",
 *       required=true,
 *       @OA\Schema(
 *          type="object",
 *          example="{}",
 *          @OA\Property(
 *              property="Accept",
 *              type="string",
 *          ),
 *       )
 *     ),
 *     @OA\Parameter(
 *       name="Authorization",
 *       in="header",
 *       description="Bearer {access_token}",
 *       required=true,
 *       @OA\Schema(
 *          type="object",
 *          example="Bearer replace_with_access_token",
 *          @OA\Property(
 *              property="Authorization",
 *              type="string",
 *          ),
 *       )
 *     ),
 *     @OA\Parameter(
 *       name="limit",
 *       in="query",
 *       description="Specify the number of records to return",
 *       required=false,
 *       @OA\Schema(
 *          type="integer"
 *       )
 *     ),
 *     @OA\Parameter(
 *       name="offset",
 *       in="query",
 *       description="offset relative to the beginning of the received list in a situation",
 *       required=false,
 *       @OA\Schema(
 *          type="integer"
 *       )
 *     ),
 *     @OA\RequestBody(
 *       required=false,
 *       description="No need",
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="OK",
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(ref="#/components/schemas/ItemResponce")
 *         )
 *     ),
 *     @OA\Response(
 *         response=401,
 *         description="Not found",
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(ref="#/components/schemas/Error")
 *         )
 *     ),
 *     @OA\Response(
 *         response=500,
 *         description="Server Error.",
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(ref="#/components/schemas/Error")
 *         )
 *     )
 * )
 */

/**
 * @OA\Get(
 *     tags={"Items"},
 *     path="/items/{item_id}",
 *     summary="Get Item by id",
 *     @OA\Parameter(
 *       name="Accept",
 *       in="header",
 *       description="Define content type of response",
 *       required=true,
 *       @OA\Schema(
 *          type="object",
 *          example="{}",
 *          @OA\Property(
 *              property="Accept",
 *              type="string",
 *          ),
 *       )
 *     ),
 *     @OA\Parameter(
 *       name="Authorization",
 *       in="header",
 *       description="Bearer {access_token}",
 *       required=true,
 *       @OA\Schema(
 *          type="object",
 *          example="Bearer replace_with_access_token",
 *          @OA\Property(
 *              property="Authorization",
 *              type="string",
 *          ),
 *       )
 *     ),
 *     @OA\Parameter(
 *       name="item_id",
 *       in="path",
 *       description="Existing Item id",
 *       required=true,
 *       @OA\Schema(
 *          type="object",
 *          example="1",
 *          @OA\Property(
 *              property="item_id",
 *              type="integer",
 *          ),
 *       )
 *     ),
 *     @OA\RequestBody(
 *       required=false,
 *       description="No need",
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="OK",
 *         @OA\JsonContent(
 *          @OA\Property(
 *              property="status",
 *              type="integer",
 *              example="200",
 *          ),
 *          @OA\Property(
 *              property="message",
 *              type="string",
 *              example="Success",
 *          ),
 *          @OA\Property(
 *              property="data",
 *              ref="#/components/schemas/Item",
 *          ),
 *         )
 *     ),
 *     @OA\Response(
 *         response=401,
 *         description="Unauthorized.",
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(ref="#/components/schemas/Error")
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Not found.",
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(ref="#/components/schemas/Error")
 *         )
 *     ),
 *     @OA\Response(
 *         response=500,
 *         description="Server Error.",
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(ref="#/components/schemas/Error")
 *         )
 *     )
 * )
 */

/**
 * @OA\Get(
 *     tags={"Items"},
 *     path="/item-statuses",
 *     summary="Get Item status list",
 *     @OA\Parameter(
 *       name="Accept",
 *       in="header",
 *       description="Define content type of response",
 *       required=true,
 *       @OA\Schema(
 *          type="object",
 *          example="application/json",
 *          @OA\Property(
 *              property="Accept",
 *              type="string",
 *          ),
 *       )
 *     ),
 *     @OA\Parameter(
 *       name="Authorization",
 *       in="header",
 *       description="Bearer {access_token}",
 *       required=true,
 *       @OA\Schema(
 *          type="object",
 *          example="Bearer replace_with_access_token",
 *          @OA\Property(
 *              property="Authorization",
 *              type="string",
 *          ),
 *       )
 *     ),
 *     @OA\RequestBody(
 *       required=false,
 *       description="No need",
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="OK",
 *         @OA\MediaType(
 *             mediaType="application/json",
 *            @OA\Schema(
 *               type="array",
 *               @OA\Items(),
 *               example="{
    status: 200, 
    message : 'Success.',
    data: [
        {
            id : 1,
            name : 'stolen'
        },
        {
            id : 2,
            name : 'lost'
        }
    ]
}")
 *         )
 *     ),
 *     @OA\Response(
 *         response=401,
 *         description="Not found",
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(ref="#/components/schemas/Error")
 *         )
 *     ),
 *     @OA\Response(
 *         response=500,
 *         description="Server Error.",
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(ref="#/components/schemas/Error")
 *         )
 *     )
 * )
 */

/**
 * @OA\Post(
 *     tags={"Items"},
 *     path="/items",
 *     summary="Create new Item",
 *     @OA\Parameter(
 *       name="Accept",
 *       in="header",
 *       description="Define content type of response",
 *       required=true,
 *       @OA\Schema(
 *          type="object",
 *          example="{}",
 *          @OA\Property(
 *              property="Accept",
 *              type="string",
 *          ),
 *       )
 *     ),
 *     @OA\Parameter(
 *       name="Authorization",
 *       in="header",
 *       description="Bearer {access_token}",
 *       required=true,
 *       @OA\Schema(
 *          type="object",
 *          example="Bearer replace_with_access_token",
 *          @OA\Property(
 *              property="Authorization",
 *              type="string",
 *          ),
 *       )
 *     ),
 *     @OA\RequestBody(
 *       required=true,
 *       description="Item required fields",
 *       @OA\MediaType(
 *         mediaType="application/json",
 *         @OA\Schema(
 *           @OA\Property(
 *               property="title",
 *               type="string"
 *           ),
 *           @OA\Property(
 *               property="description",
 *               type="string"
 *           ),
 *           @OA\Property(
 *               property="status_id",
 *               type="integer"
 *           ),
 *           @OA\Property(
 *               property="category_id",
 *               type="integer"
 *           ),
 *           @OA\Property(
 *               property="reward",
 *               type="integer"
 *           ),
 *           @OA\Property(
 *               property="serial_number",
 *               type="string"
 *           ),
 *           @OA\Property(
 *               property="trasfer_ownership",
 *               type="integer"
 *           ),
 *           @OA\Property(
 *               property="photos",
 *               type="object",
 *               example={}
 *           ),
 *         )
 *       )
 *     ),
 *     @OA\Response(
 *         response=201,
 *         description="Created.",
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\JsonContent(
 *                 @OA\Property(
 *                     property="status",
 *                     type="integer",
 *                     example="201",
 *                 ),
 *                 @OA\Property(
 *                     property="message",
 *                     type="string",
 *                     example="Created.",
 *                 ),
 *                 @OA\Property(
 *                     property="data",
 *                     ref="#/components/schemas/Item",
 *                 ),
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=400,
 *         description="Bad Request.",
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(ref="#/components/schemas/Responce400")
 *         )
 *     ),
 *     @OA\Response(
 *         response=401,
 *         description="Unauthorized.",
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(ref="#/components/schemas/Error")
 *         )
 *     ),
 *     @OA\Response(
 *         response=500,
 *         description="Server Error.",
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(ref="#/components/schemas/Error")
 *         )
 *     )
 * )
 */

/**
 * @OA\Post(
 *     tags={"Items"},
 *     path="/items/{item_id}",
 *     summary="Update Item",
 *     @OA\Parameter(
 *       name="Accept",
 *       in="header",
 *       description="Define content type of response",
 *       required=true,
 *       @OA\Schema(
 *          type="string",
 *          example="application/json",
 *          @OA\Property(
 *              property="Accept",
 *              type="string",
 *              example="application/json",
 *          ),
 *       )
 *     ),
 *     @OA\Parameter(
 *       name="Authorization",
 *       in="header",
 *       description="Bearer {access_token}",
 *       required=true,
 *       @OA\Schema(
 *          type="string",
 *          example="Bearer replace_with_access_token",
 *          @OA\Property(
 *              property="Authorization",
 *              type="string",
 *              example="Bearer replace_with_access_token",
 *          ),
 *       )
 *     ),
 *     @OA\Parameter(
 *       name="item_id",
 *       in="path",
 *       description="Existing Item id",
 *       required=true,
 *       @OA\Schema(
 *          type="integer",
 *          example="2",
 *          @OA\Property(
 *              property="item_id",
 *              type="integer",
 *          ),
 *       ),
 *     ),
 *     @OA\RequestBody(
 *       required=true,
 *       description="Enter User email , password and password confirmation.",
 *       @OA\MediaType(
 *         mediaType="multipart/form-data",
 *         @OA\Schema(
 *           @OA\Property(
 *               property="_method",
 *               type="string",
 *               example="put",
 *           ),
 *           @OA\Property(
 *               property="status_id",
 *               type="integer",
 *               example="2",
 *           ),
 *           @OA\Property(
 *               property="photos",
 *               type="array",
 *               @OA\Items(),
 *               example={}
 *           ),
 *         )
 *       )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="OK",
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\JsonContent(
 *                 @OA\Property(
 *                     property="status",
 *                     type="integer",
 *                     example="200",
 *                 ),
 *                 @OA\Property(
 *                     property="message",
 *                     type="string",
 *                     example="Updated.",
 *                 ),
 *                 @OA\Property(
 *                     property="data",
 *                     ref="#/components/schemas/Item",
 *                 ),
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=401,
 *         description="Unauthorized.",
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(ref="#/components/schemas/Error")
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Not Found.",
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(ref="#/components/schemas/Error")
 *         )
 *     ),
 *     @OA\Response(
 *         response=500,
 *         description="Server Error.",
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(ref="#/components/schemas/Error")
 *         )
 *     )
 * )
 */

/**
 * @OA\Delete(
 *     tags={"Items"},
 *     path="/items/{item_id}",
 *     summary="Delete item",
 *     @OA\Parameter(
 *       name="Accept",
 *       in="header",
 *       description="Define content type of response",
 *       required=true,
 *       @OA\Schema(
 *          type="object",
 *          example="{}",
 *          @OA\Property(
 *              property="Accept",
 *              type="string",
 *          ),
 *       )
 *     ),
 *     @OA\Parameter(
 *       name="Authorization",
 *       in="header",
 *       description="Bearer {access_token}",
 *       required=true,
 *       @OA\Schema(
 *          type="object",
 *          example="Bearer replace_with_access_token",
 *          @OA\Property(
 *              property="Authorization",
 *              type="string",
 *          ),
 *       )
 *     ),
 *     @OA\Parameter(
 *       name="item_id",
 *       in="path",
 *       description="Existing Item id",
 *       required=true,
 *       @OA\Schema(
 *          type="object",
 *          example="2",
 *          @OA\Property(
 *              property="item_id",
 *              type="integer",
 *          ),
 *       ),
 *     ),
 *     @OA\RequestBody(
 *       required=false,
 *       description="No need.",
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="OK.",
 *     ),
 *     @OA\Response(
 *         response=401,
 *         description="Unauthorized.",
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(ref="#/components/schemas/Error")
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Not Found.",
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(ref="#/components/schemas/Error")
 *         )
 *     ),
 *     @OA\Response(
 *         response=500,
 *         description="Server Error.",
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(ref="#/components/schemas/Error")
 *         )
 *     )
 * )
 */

/**
 * @OA\Delete(
 *     tags={"Items"},
 *     path="/items/delete-file/{item_id}/{file_name}",
 *     summary="Delete item file",
 *     @OA\Parameter(
 *       name="Accept",
 *       in="header",
 *       description="Define content type of response",
 *       required=true,
 *       @OA\Schema(
 *          type="object",
 *          example="{}",
 *          @OA\Property(
 *              property="Accept",
 *              type="string",
 *          ),
 *       )
 *     ),
 *     @OA\Parameter(
 *       name="Authorization",
 *       in="header",
 *       description="Bearer {access_token}",
 *       required=true,
 *       @OA\Schema(
 *          type="object",
 *          example="Bearer replace_with_access_token",
 *          @OA\Property(
 *              property="Authorization",
 *              type="string",
 *          ),
 *       )
 *     ),
 *     @OA\Parameter(
 *       name="item_id",
 *       in="path",
 *       description="Existing Item id",
 *       required=true,
 *       @OA\Schema(
 *          type="object",
 *          example="2",
 *          @OA\Property(
 *              property="item_id",
 *              type="integer",
 *          ),
 *       ),
 *     ),
 *     @OA\Parameter(
 *       name="file_name",
 *       in="path",
 *       description="Existing Item file name",
 *       required=true,
 *       @OA\Schema(
 *          type="object",
 *          example="5c0526e6d8990.jpg",
 *          @OA\Property(
 *              property="file_name",
 *              type="string",
 *          ),
 *       ),
 *     ),
 *     @OA\RequestBody(
 *       required=false,
 *       description="No need.",
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="OK.",
 *     ),
 *     @OA\Response(
 *         response=401,
 *         description="Unauthorized.",
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(ref="#/components/schemas/Error")
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Not Found.",
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(ref="#/components/schemas/Error")
 *         )
 *     ),
 *     @OA\Response(
 *         response=500,
 *         description="Server Error.",
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(ref="#/components/schemas/Error")
 *         )
 *     )
 * )
 */

/**
 * @OA\Get(
 *     tags={"Items"},
 *     path="/items/reported",
 *     summary="Get items with sent reports",
 *     @OA\Parameter(
 *       name="Accept",
 *       in="header",
 *       description="Define content type of response",
 *       required=true,
 *       @OA\Schema(
 *          type="object",
 *          example="{}",
 *          @OA\Property(
 *              property="Accept",
 *              type="string",
 *          ),
 *       )
 *     ),
 *     @OA\Parameter(
 *       name="Authorization",
 *       in="header",
 *       description="Bearer {access_token}",
 *       required=true,
 *       @OA\Schema(
 *          type="object",
 *          example="Bearer replace_with_access_token",
 *          @OA\Property(
 *              property="Authorization",
 *              type="string",
 *          ),
 *       )
 *     ),
 *     @OA\RequestBody(
 *       required=false,
 *       description="No need",
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="OK",
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Items(ref="#/components/schemas/ItemResponce")
 *         )
 *     ),
 *     @OA\Response(
 *         response=401,
 *         description="Not found",
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(ref="#/components/schemas/Error")
 *         )
 *     ),
 *     @OA\Response(
 *         response=500,
 *         description="Server Error.",
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(ref="#/components/schemas/Error")
 *         )
 *     )
 * )
 */

/**
 * @OA\Get(
 *     tags={"Items"},
 *     path="/items/founded",
 *     summary="Get items with founded(received) reports",
 *     @OA\Parameter(
 *       name="Accept",
 *       in="header",
 *       description="Define content type of response",
 *       required=true,
 *       @OA\Schema(
 *          type="object",
 *          example="{}",
 *          @OA\Property(
 *              property="Accept",
 *              type="string",
 *          ),
 *       )
 *     ),
 *     @OA\Parameter(
 *       name="Authorization",
 *       in="header",
 *       description="Bearer {access_token}",
 *       required=true,
 *       @OA\Schema(
 *          type="object",
 *          example="Bearer replace_with_access_token",
 *          @OA\Property(
 *              property="Authorization",
 *              type="string",
 *          ),
 *       )
 *     ),
 *     @OA\RequestBody(
 *       required=false,
 *       description="No need",
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="OK",
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Items(ref="#/components/schemas/ItemResponce")
 *         )
 *     ),
 *     @OA\Response(
 *         response=401,
 *         description="Not found",
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(ref="#/components/schemas/Error")
 *         )
 *     ),
 *     @OA\Response(
 *         response=500,
 *         description="Server Error.",
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(ref="#/components/schemas/Error")
 *         )
 *     )
 * )
 */

/**
 * @OA\Get(
 *     tags={"Reports"},
 *     path="/item/{item_id}/reports",
 *     summary="Get item reports by item id",
 *     @OA\Parameter(
 *       name="Accept",
 *       in="header",
 *       description="Define content type of response",
 *       required=true,
 *       @OA\Schema(
 *          type="object",
 *          example={"accept":"application/json"},
 *          @OA\Property(
 *              property="Accept",
 *              type="string",
 *          ),
 *       )
 *     ),
 *     @OA\Parameter(
 *       name="Authorization",
 *       in="header",
 *       description="Bearer {access_token}",
 *       required=true,
 *       @OA\Schema(
 *          type="object",
 *          example="Bearer replace_with_access_token",
 *          @OA\Property(
 *              property="Authorization",
 *              type="string",
 *          ),
 *       )
 *     ),
 *     @OA\Parameter(
 *       name="item_id",
 *       in="path",
 *       description="Item id",
 *       required=true,
 *       @OA\Schema(
 *          type="integer",
 *          example="1",
 *          @OA\Property(
 *              property="item_id",
 *              type="integer",
 *          ),
 *       )
 *     ),
 *     @OA\Parameter(
 *       name="limit",
 *       in="query",
 *       description="Specify the number of records to return",
 *       required=false,
 *       @OA\Schema(
 *          type="integer"
 *       )
 *     ),
 *     @OA\Parameter(
 *       name="offset",
 *       in="query",
 *       description="offset relative to the beginning of the received list in a situation",
 *       required=false,
 *       @OA\Schema(
 *          type="integer"
 *       )
 *     ),
 *     @OA\RequestBody(
 *       required=false,
 *       description="No need",
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="OK",
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Items(ref="#/components/schemas/ReportResponce")
 *         )
 *     ),
 *     @OA\Response(
 *         response=401,
 *         description="Unauthorized.",
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(ref="#/components/schemas/Error")
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Not Found.",
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(ref="#/components/schemas/Error")
 *         )
 *     ),
 *     @OA\Response(
 *         response=500,
 *         description="Server Error.",
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(ref="#/components/schemas/Error")
 *         )
 *     )
 * )
 */

/**
 * @OA\Get(
 *     tags={"Reports"},
 *     path="/reports/{report_id}",
 *     summary="Get report by id",
 *     @OA\Parameter(
 *       name="Accept",
 *       in="header",
 *       description="Define content type of response",
 *       required=true,
 *       @OA\Schema(
 *          type="object",
 *          example={"accept":"application/json"},
 *          @OA\Property(
 *              property="Accept",
 *              type="string",
 *          ),
 *       )
 *     ),
 *     @OA\Parameter(
 *       name="Authorization",
 *       in="header",
 *       description="Bearer {access_token}",
 *       required=true,
 *       @OA\Schema(
 *          type="object",
 *          example="Bearer replace_with_access_token",
 *          @OA\Property(
 *              property="Authorization",
 *              type="string",
 *          ),
 *       )
 *     ),
 *     @OA\Parameter(
 *       name="report_id",
 *       in="path",
 *       description="Report id",
 *       required=true,
 *       @OA\Schema(
 *          type="integer",
 *          example="1",
 *          @OA\Property(
 *              property="report_id",
 *              type="integer",
 *          ),
 *       )
 *     ),
 *     @OA\RequestBody(
 *       required=false,
 *       description="No need",
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="OK",
 *         @OA\JsonContent(
 *             allOf={
 *                  @OA\Schema(ref="#/components/schemas/Responce2xx"),
 *                  @OA\Property(
 *                      property="data",
 *                      type="object",
 *                      @OA\Property(
 *                          property="data",
 *                          ref="#/components/schemas/Report"
 *                      ),
 *                  ),
 *             }
 *         ),
 *     ),
 *     @OA\Response(
 *         response=401,
 *         description="Unauthorized.",
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(ref="#/components/schemas/Error")
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Not Found.",
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(ref="#/components/schemas/Error")
 *         )
 *     ),
 *     @OA\Response(
 *         response=500,
 *         description="Server Error.",
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(ref="#/components/schemas/Error")
 *         )
 *     )
 * )
 */

/**
 * @OA\Post(
 *     tags={"Reports"},
 *     path="/item/{item_id}/reports",
 *     summary="Add report to Item",
 *     @OA\Parameter(
 *       name="Accept",
 *       in="header",
 *       description="Define content type of response",
 *       required=true,
 *       @OA\Schema(
 *          type="object",
 *          example={"accept":"application/json"},
 *          @OA\Property(
 *              property="Accept",
 *              type="string",
 *          ),
 *       )
 *     ),
 *     @OA\Parameter(
 *       name="Authorization",
 *       in="header",
 *       description="Bearer {access_token}",
 *       required=true,
 *       @OA\Schema(
 *          type="object",
 *          example="Bearer replace_with_access_token",
 *          @OA\Property(
 *              property="Authorization",
 *              type="string",
 *          ),
 *       )
 *     ),
 *     @OA\Parameter(
 *       name="item_id",
 *       in="path",
 *       description="Item id",
 *       required=true,
 *       @OA\Schema(
 *          type="integer",
 *          example="1",
 *          @OA\Property(
 *              property="item_id",
 *              type="integer",
 *          ),
 *       )
 *     ),
 *     @OA\RequestBody(
 *       required=true,
 *       description="Report required fields",
 *       @OA\MediaType(
 *         mediaType="multipart/form-data",
 *         @OA\Schema(
 *           @OA\Property(
 *               property="email",
 *               type="string"
 *           ),
 *           @OA\Property(
 *               property="name",
 *               type="string"
 *           ),
 *           @OA\Property(
 *               property="address",
 *               type="string"
 *           ),
 *           @OA\Property(
 *               property="website",
 *               type="string"
 *           ),
 *           @OA\Property(
 *               property="text",
 *               type="string"
 *           ),
 *           @OA\Property(
 *               property="photos",
 *               type="file",
 *               example={}
 *           ),
 *         )
 *       )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="OK",
 *         @OA\JsonContent(
 *             allOf={
 *                  @OA\Schema(ref="#/components/schemas/Responce2xx"),
 *                  @OA\Property(
 *                      property="data",
 *                      type="object",
 *                      @OA\Property(
 *                          property="data",
 *                          ref="#/components/schemas/Report"
 *                      ),
 *                  ),
 *             }
 *         ),
 *     ),
 *     @OA\Response(
 *         response=400,
 *         description="Bad Request.",
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(ref="#/components/schemas/Responce400")
 *         )
 *     ),
 *     @OA\Response(
 *         response=401,
 *         description="Unauthorized.",
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(ref="#/components/schemas/Error")
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Not Found.",
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(ref="#/components/schemas/Error")
 *         )
 *     ),
 *     @OA\Response(
 *         response=500,
 *         description="Server Error.",
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(ref="#/components/schemas/Error")
 *         )
 *     )
 * )
 */

/**
 * @OA\Get(
 *     tags={"Reports"},
 *     path="/item/report-statuses",
 *     summary="Get item report statuses",
 *     @OA\Parameter(
 *       name="Accept",
 *       in="header",
 *       description="Define content type of response",
 *       required=true,
 *       @OA\Schema(
 *          type="object",
 *          example={"accept":"application/json"},
 *          @OA\Property(
 *              property="Accept",
 *              type="string",
 *          ),
 *       )
 *     ),
 *     @OA\Parameter(
 *       name="Authorization",
 *       in="header",
 *       description="Bearer {access_token}",
 *       required=true,
 *       @OA\Schema(
 *          type="object",
 *          example="Bearer replace_with_access_token",
 *          @OA\Property(
 *              property="Authorization",
 *              type="string",
 *          ),
 *       )
 *     ),
 *     @OA\RequestBody(
 *       required=false,
 *       description="No need",
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="OK",
 *         @OA\MediaType(
 *             mediaType="application/json",
 *            @OA\Schema(
 *               type="array",
 *               @OA\Items(),
 *               example="{
    status: 200, 
    message : 'Success.',
    data: [
        {
            id : 1,
            name : 'pending'
        },
        {
            id : 2,
            name : 'approved'
        },
        {
            id : 3,
            name : 'rejected'
        },
        {
            id : 4,
            name : 'under_review'
        }
    ]
}")
 *         )
 *     ),
 *     @OA\Response(
 *         response=401,
 *         description="Unauthorized.",
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(ref="#/components/schemas/Error")
 *         )
 *     ),
 *     @OA\Response(
 *         response=500,
 *         description="Server Error.",
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(ref="#/components/schemas/Error")
 *         )
 *     )
 * )
 */

/**
 * @OA\Get(
 *     tags={"Category"},
 *     path="/categories/{category_id}",
 *     summary="Get categories or category by id.",
 *     @OA\Parameter(
 *       name="Accept",
 *       in="header",
 *       description="Define content type of response",
 *       required=true,
 *       @OA\Schema(
 *          type="object",
 *          example={"accept":"application/json"},
 *          @OA\Property(
 *              property="Accept",
 *              type="string",
 *          ),
 *       )
 *     ),
 *     @OA\Parameter(
 *       name="Authorization.",
 *       in="header",
 *       description="Bearer {access_token}",
 *       required=true,
 *       @OA\Schema(
 *          type="object",
 *          example="Bearer replace_with_access_token",
 *          @OA\Property(
 *              property="Authorization",
 *              type="string",
 *          ),
 *       )
 *     ),
 *     @OA\Parameter(
 *       name="category_id",
 *       in="path",
 *       description="Category id",
 *       required=false,
 *       @OA\Schema(
 *          type="integer",
 *          example="1",
 *          @OA\Property(
 *              property="category_id",
 *              type="integer",
 *          ),
 *       )
 *     ),
 *     @OA\RequestBody(
 *       required=false,
 *       description="No need",
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="OK",
 *         @OA\MediaType(
 *             mediaType="application/json",
 *            @OA\Schema(
 *               type="array",
 *               @OA\Items(),
 *               example="{
    status: 200, 
    message : 'Success.',
    data: [
        {
            id: 1,
            parent_id: null,
            name: 'Accessories'
        },
        {
            id: 22,
            parent_id: null,
            name: 'Automotive'
        },
        {
            id: 39,
            parent_id: null,
            name: 'Bicycles'
        }
    ]
}")
 *         )
 *     ),
 *     @OA\Response(
 *         response=401,
 *         description="Unauthorized",
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(ref="#/components/schemas/Error")
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Not found.",
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(ref="#/components/schemas/Error")
 *         )
 *     ),
 *     @OA\Response(
 *         response=500,
 *         description="Server Error.",
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(ref="#/components/schemas/Error")
 *         )
 *     )
 * )
 */

/**
 * @OA\Get(
 *     tags={"Category"},
 *     path="/categories/{category_id}/subs",
 *     summary="Get subcategories  by category id.",
 *     @OA\Parameter(
 *       name="Accept",
 *       in="header",
 *       description="Define content type of response",
 *       required=true,
 *       @OA\Schema(
 *          type="object",
 *          example={"accept":"application/json"},
 *          @OA\Property(
 *              property="Accept",
 *              type="string",
 *          ),
 *       )
 *     ),
 *     @OA\Parameter(
 *       name="Authorization",
 *       in="header",
 *       description="Bearer {access_token}",
 *       required=true,
 *       @OA\Schema(
 *          type="object",
 *          example="Bearer replace_with_access_token",
 *          @OA\Property(
 *              property="Authorization",
 *              type="string",
 *          ),
 *       )
 *     ),
 *     @OA\Parameter(
 *       name="category_id",
 *       in="path",
 *       description="Category id",
 *       required=true,
 *       @OA\Schema(
 *          type="integer",
 *          example="1",
 *          @OA\Property(
 *              property="category_id",
 *              type="integer",
 *          ),
 *       )
 *     ),
 *     @OA\RequestBody(
 *       required=false,
 *       description="No need",
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="OK",
 *         @OA\MediaType(
 *             mediaType="application/json",
 *            @OA\Schema(
 *               type="array",
 *               @OA\Items(),
 *               example="{
    status: 200, 
    message : 'Success.',
    data: [
        {
            id: 2,
            parent_id: 1,
            name: 'Handbags'
        },
        {
            id: 3,
            parent_id: 1,
            name: 'Travel Bags'
        },
        {
            id: 4,
            parent_id: 1,
            name: 'Suitcases'
        }
    ]
}")
 *         )
 *     ),
 *     @OA\Response(
 *         response=401,
 *         description="Unauthorized.",
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(ref="#/components/schemas/Error")
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Not Found.",
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(ref="#/components/schemas/Error")
 *         )
 *     ),
 *     @OA\Response(
 *         response=500,
 *         description="Server Error.",
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(ref="#/components/schemas/Error")
 *         )
 *     )
 * )
 */

/**
 * @OA\Get(
 *     tags={"Search"},
 *     path="/search/items/{query}[/{filters}]",
 *     summary="Search items",
 *     @OA\Parameter(
 *       name="Accept",
 *       in="header",
 *       description="Define content type of response",
 *       required=true,
 *       @OA\Schema(
 *          type="object",
 *          example={"accept":"application/json"},
 *          @OA\Property(
 *              property="Accept",
 *              type="string",
 *          ),
 *       )
 *     ),
 *     @OA\Parameter(
 *       name="Authorization",
 *       in="header",
 *       description="Bearer {access_token}",
 *       required=true,
 *       @OA\Schema(
 *          type="object",
 *          example="Bearer replace_with_access_token",
 *          @OA\Property(
 *              property="Authorization",
 *              type="string",
 *          ),
 *       )
 *     ),
 *     @OA\Parameter(
 *       name="query",
 *       in="path",
 *       description="{title + description + serial_number}",
 *       required=true,
 *       @OA\Schema(
 *          type="string",
 *          example="iPhone 12GPC55",
 *          @OA\Property(
 *              property="query",
 *              type="string",
 *          ),
 *       )
 *     ),
 *     @OA\Parameter(
 *       name="filters",
 *       in="path",
 *       description="{category_name + subcategory_name + status_name}",
 *       required=false,
 *       @OA\Schema(
 *          type="string",
 *          example="iPhone 12GPC55",
 *          @OA\Property(
 *              property="filters",
 *              type="string",
 *          ),
 *       )
 *     ),
 *     @OA\RequestBody(
 *       required=false,
 *       description="No need",
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="OK",
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(ref="#/components/schemas/SearchItemsResponce")
 *         ),
 *     ),
 *     @OA\Response(
 *         response=401,
 *         description="Unauthorized.",
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(ref="#/components/schemas/Error")
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Not Found.",
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(ref="#/components/schemas/Error")
 *         )
 *     ),
 *     @OA\Response(
 *         response=500,
 *         description="Server Error.",
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(ref="#/components/schemas/Error")
 *         )
 *     )
 * )
 */
