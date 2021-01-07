/* tslint:disable */
/* eslint-disable */
// This file was automatically generated and should not be edited.

//==============================================================
// START Enums and Input Objects
//==============================================================

/**
 * Action type categories
 */
export enum ActivityActionType {
  LIKES = "LIKES",
  MESSAGES_CREATED = "MESSAGES_CREATED",
  READS = "READS",
}

/**
 * Time type categories
 */
export enum ActivityTimeframeType {
  SEVEN_DAYS = "SEVEN_DAYS",
  TWELVE_MONTHS = "TWELVE_MONTHS",
  TWENTYEIGHT_DAYS = "TWENTYEIGHT_DAYS",
}

/**
 * Enum for allowed file type, this is a backend uploading setting
 */
export enum AllowedUploadFileType {
  ALL = "ALL",
  MEDIA = "MEDIA",
  NONE = "NONE",
}

/**
 * Type of App Activity State
 */
export enum AppActivityState {
  ACTIVE_MOBILE = "ACTIVE_MOBILE",
  ACTIVE_WEB = "ACTIVE_WEB",
  IDLE_WEB = "IDLE_WEB",
}

/**
 * A filter for the suggested autocomplete group results
 */
export enum AutocompleteGroupResultFilter {
  VIEWER_CAN_START_THREAD = "VIEWER_CAN_START_THREAD",
}

/**
 * A filter for the suggested autocomplete group results
 */
export enum AutocompleteUserResultFilter {
  EXCLUDE_EXTERNAL = "EXCLUDE_EXTERNAL",
}

/**
 * Type of Broadcast Activity State
 */
export enum BroadcastActivityState {
  NOT_WATCHING = "NOT_WATCHING",
  WATCHING = "WATCHING",
}

/**
 * Enum for the type of event
 */
export enum BroadcastEventType {
  TEAMS = "TEAMS",
  YAMMER_BYOE = "YAMMER_BYOE",
  YAMMER_GOLIVE = "YAMMER_GOLIVE",
  YAMMER_QUICKSTART = "YAMMER_QUICKSTART",
}

/**
 * Types of broadcast feeds.
 */
export enum BroadcastFeedType {
  ALL = "ALL",
  MODERATION_DISMISSED = "MODERATION_DISMISSED",
  MODERATION_PENDING = "MODERATION_PENDING",
  MODERATION_PENDING_QUESTIONS = "MODERATION_PENDING_QUESTIONS",
  QUESTIONS = "QUESTIONS",
  UNANSWERED_QUESTIONS = "UNANSWERED_QUESTIONS",
  VIEWER_IS_THREAD_STARTER_SENDER = "VIEWER_IS_THREAD_STARTER_SENDER",
}

/**
 * The status of the broadcast.
 */
export enum BroadcastStatus {
  CREATED = "CREATED",
  ENDED = "ENDED",
  STARTED = "STARTED",
}

/**
 * available convertable types to convert legacy ID from/to graph ID
 */
export enum ConvertibleObjectType {
  GROUP = "GROUP",
  MESSAGE = "MESSAGE",
  THREAD = "THREAD",
  TOPIC = "TOPIC",
  USER = "USER",
}

/**
 * Delegate role type in a DelegateTeam
 */
export enum DelegateRole {
  CONTENT_CONTRIBUTOR = "CONTENT_CONTRIBUTOR",
  DELEGATE_MANAGER = "DELEGATE_MANAGER",
}

/**
 * Determine the hidden status of a group
 */
export enum DiscoveryHiddenState {
  HIDDEN = "HIDDEN",
  NOT_HIDDEN = "NOT_HIDDEN",
  NOT_RETRIEVED = "NOT_RETRIEVED",
}

/**
 * The state of the file
 */
export enum FileState {
  ACTIVE = "ACTIVE",
  DELETED = "DELETED",
  INACCESSIBLE = "INACCESSIBLE",
}

/**
 * Group categories
 */
export enum GroupCategory {
  COMMUNITY = "COMMUNITY",
  NONE = "NONE",
  OTHER = "OTHER",
  PROJECT = "PROJECT",
  TEAM = "TEAM",
}

/**
 * Types of group feeds.
 */
export enum GroupFeedType {
  ALL = "ALL",
  QUESTIONS = "QUESTIONS",
  UNANSWERED_QUESTIONS = "UNANSWERED_QUESTIONS",
  UNSEEN = "UNSEEN",
}

/**
 * User membership status in the group
 */
export enum GroupMembershipStatus {
  INVITED = "INVITED",
  JOINED = "JOINED",
  NONE = "NONE",
  PENDING = "PENDING",
}

/**
 * Privacy levels for a group.
 */
export enum GroupPrivacy {
  MODERATED = "MODERATED",
  PRIVATE = "PRIVATE",
  PUBLIC = "PUBLIC",
}

/**
 * Privacy level enforcement for a group.
 */
export enum GroupPrivacyEnforcement {
  ENFORCE_PRIVATE = "ENFORCE_PRIVATE",
  ENFORCE_PUBLIC = "ENFORCE_PUBLIC",
  NONE = "NONE",
}

/**
 * The states a group can be in
 */
export enum GroupState {
  ACTIVE = "ACTIVE",
  DELETED = "DELETED",
  INACCESSIBLE = "INACCESSIBLE",
}

/**
 * Different ranking algorithms for sorting group suggestions
 */
export enum GroupSuggestionRank {
  DISCOVERY_RANK = "DISCOVERY_RANK",
  LEGACY_PROXIMITY_RANK = "LEGACY_PROXIMITY_RANK",
  LEGACY_USER_RANK = "LEGACY_USER_RANK",
}

/**
 * Possible feed types content can be loaded from
 */
export enum HomeFeedType {
  ALL_PUBLIC_GROUPS = "ALL_PUBLIC_GROUPS",
  DISCOVERY = "DISCOVERY",
  FOLLOWING_AND_ALLCOMPANY = "FOLLOWING_AND_ALLCOMPANY",
  LEGACY_DISCOVERY = "LEGACY_DISCOVERY",
}

/**
 * The types of feeds that can be returned from an inbox.
 */
export enum InboxFeedType {
  ALL = "ALL",
  DIRECT = "DIRECT",
  UNREAD = "UNREAD",
}

/**
 * Enum for the protocol of the ingest url
 */
export enum IngestProtocol {
  HTTP = "HTTP",
  HTTPS = "HTTPS",
  RTMP = "RTMP",
  RTMPS = "RTMPS",
}

/**
 * Enum for the type ol the ingest url
 */
export enum IngestType {
  PRIMARY = "PRIMARY",
  SECONDARY = "SECONDARY",
}

/**
 * Message Content Type
 */
export enum MessageContentType {
  NORMAL = "NORMAL",
  QUESTION = "QUESTION",
}

/**
 * Moderation states for Message.
 */
export enum MessageModerationState {
  DISMISSED = "DISMISSED",
  PENDING = "PENDING",
}

/**
 * List of feed types to mark for ocular views @deprecated(reason: 'use FeedThreadTelemetryContext')
 */
export enum MessageSeenInFeedType {
  ALL_COMPANY = "ALL_COMPANY",
  GROUP = "GROUP",
  HOME = "HOME",
  TOPIC = "TOPIC",
  USER = "USER",
}

/**
 * Month type categories
 */
export enum MonthType {
  APR = "APR",
  AUG = "AUG",
  DEC = "DEC",
  FEB = "FEB",
  JAN = "JAN",
  JUL = "JUL",
  JUN = "JUN",
  MAR = "MAR",
  MAY = "MAY",
  NOV = "NOV",
  OCT = "OCT",
  SEP = "SEP",
}

/**
 * The target where a thread is to be pinned.
 */
export enum PinnedThreadFeedTarget {
  BROADCAST = "BROADCAST",
  GROUP = "GROUP",
  TEAMS_MEETING = "TEAMS_MEETING",
}

/**
 * Types of praise badges/icons shown on the UI
 */
export enum PraiseBadge {
  ACE = "ACE",
  CHECKEREDFLAG = "CHECKEREDFLAG",
  COFFEE = "COFFEE",
  DIAMOND = "DIAMOND",
  DOUBLERAINBOW = "DOUBLERAINBOW",
  GIFT = "GIFT",
  GLASSES = "GLASSES",
  GRADUATIONCAP = "GRADUATIONCAP",
  HEART = "HEART",
  LIGHTBULB = "LIGHTBULB",
  MONEY = "MONEY",
  MONOCLE = "MONOCLE",
  NINJA = "NINJA",
  PIE = "PIE",
  STAR = "STAR",
  THUMBSUP = "THUMBSUP",
  TROPHY = "TROPHY",
}

/**
 * Question types enum
 */
export enum QuestionActivityType {
  BEST_REPLIES_MARKED = "BEST_REPLIES_MARKED",
  QUESTIONS_ASKED = "QUESTIONS_ASKED",
  REPLIES_TO_QUESTION = "REPLIES_TO_QUESTION",
}

/**
 * Types of reactions to things.
 */
export enum Reaction {
  CELEBRATE = "CELEBRATE",
  LAUGH = "LAUGH",
  LIKE = "LIKE",
  LOVE = "LOVE",
  SAD = "SAD",
  THANK = "THANK",
}

/**
 * The storage provider used for a given file
 */
export enum StorageProvider {
  AZURE = "AZURE",
  SHAREPOINT = "SHAREPOINT",
}

/**
 * The platforms a user is subscribed to notifications on
 */
export enum SubscriptionTarget {
  ANDROID = "ANDROID",
  EMAIL = "EMAIL",
  IOS = "IOS",
}

/**
 * Types of Teams meeting feeds.
 */
export enum TeamsMeetingFeedType {
  ALL = "ALL",
  MODERATION_DISMISSED = "MODERATION_DISMISSED",
  MODERATION_PENDING = "MODERATION_PENDING",
  MODERATION_PENDING_QUESTIONS = "MODERATION_PENDING_QUESTIONS",
  QUESTIONS = "QUESTIONS",
  UNANSWERED_QUESTIONS = "UNANSWERED_QUESTIONS",
  VIEWER_IS_THREAD_STARTER_SENDER = "VIEWER_IS_THREAD_STARTER_SENDER",
}

/**
 * The status of the Teams meeting
 */
export enum TeamsMeetingStatus {
  CREATED = "CREATED",
  ENDED = "ENDED",
  STARTED = "STARTED",
}

/**
 * List of the subtypes and filters of feeds that can be sent, along with the
 * overall type, to telemetry endpoints or used when marking threads and messages as seen
 */
export enum TelemetryFeedSubtype {
  ACTIVITY_FEATURED_REPLIES = "ACTIVITY_FEATURED_REPLIES",
  ACTIVITY_TOP_THREADS = "ACTIVITY_TOP_THREADS",
  ALL = "ALL",
  ALL_PUBLIC_GROUPS = "ALL_PUBLIC_GROUPS",
  DEFAULT = "DEFAULT",
  DIRECT = "DIRECT",
  DISCOVERY = "DISCOVERY",
  FOLLOWING_AND_ALLCOMPANY = "FOLLOWING_AND_ALLCOMPANY",
  LEGACY_DISCOVERY = "LEGACY_DISCOVERY",
  MODERATION_DISMISSED = "MODERATION_DISMISSED",
  MODERATION_PENDING = "MODERATION_PENDING",
  QUESTIONS = "QUESTIONS",
  SEARCH_GROUP = "SEARCH_GROUP",
  SEARCH_INBOX = "SEARCH_INBOX",
  SEARCH_NETWORK = "SEARCH_NETWORK",
  THREAD_DEEP_LINK = "THREAD_DEEP_LINK",
  UNANSWERED_QUESTIONS = "UNANSWERED_QUESTIONS",
  UNREAD = "UNREAD",
  UNSEEN = "UNSEEN",
  VIEWER_IS_THREAD_STARTER_SENDER = "VIEWER_IS_THREAD_STARTER_SENDER",
}

/**
 * List of the overall types of feeds that can be sent, along with subtype, to
 * telemetry endpoints or used when marking threads and messages as seen
 */
export enum TelemetryFeedType {
  ALL_COMPANY_GROUP = "ALL_COMPANY_GROUP",
  ALL_FEED = "ALL_FEED",
  ATTACHABLE_LINK = "ATTACHABLE_LINK",
  BROADCAST = "BROADCAST",
  GROUP = "GROUP",
  HOME = "HOME",
  INBOX = "INBOX",
  SEARCH = "SEARCH",
  THREAD = "THREAD",
  TOPIC = "TOPIC",
  UNKNOWN = "UNKNOWN",
  USER = "USER",
}

/**
 * The ordering to use for the thread replies
 */
export enum ThreadReplySortOrder {
  CREATED_AT = "CREATED_AT",
  UPVOTE_RANK_THEN_CREATED_AT = "UPVOTE_RANK_THEN_CREATED_AT",
}

/**
 * Types of topic feeds.
 */
export enum TopicFeedType {
  ALL = "ALL",
  QUESTIONS = "QUESTIONS",
}

/**
 * A user's accent color used to customize how reactions are rendered.
 */
export enum UserReactionAccentColor {
  FITZPATRICK_SCALE_DARK = "FITZPATRICK_SCALE_DARK",
  FITZPATRICK_SCALE_LIGHT = "FITZPATRICK_SCALE_LIGHT",
  FITZPATRICK_SCALE_MEDIUM = "FITZPATRICK_SCALE_MEDIUM",
  FITZPATRICK_SCALE_MEDIUM_DARK = "FITZPATRICK_SCALE_MEDIUM_DARK",
  FITZPATRICK_SCALE_MEDIUM_LIGHT = "FITZPATRICK_SCALE_MEDIUM_LIGHT",
  NONE = "NONE",
}

/**
 * The status of video transcoding.
 */
export enum VideoTranscodingStatus {
  FAILED = "FAILED",
  STARTED = "STARTED",
  SUCCEEDED = "SUCCEEDED",
}

/**
 * Web client preferences.
 */
export enum WebClientPreference {
  LEGACY = "LEGACY",
  MODERN = "MODERN",
  NONE = "NONE",
}

/**
 * Supported providers of video.
 */
export enum WebVideoProvider {
  O365 = "O365",
  STREAMS = "STREAMS",
  VIMEO = "VIMEO",
  YOUTUBE = "YOUTUBE",
}

/**
 * The input required to mark a group as favorite for a user
 */
export interface AddFavoriteGroupInput {
  groupId: string;
}

/**
 * The input required to add a pinned object to group relationship
 */
export interface AddPinnedObjectRelationshipInput {
  groupId: string;
  pinnedObjectId: string;
}

/**
 * The input required to add a topic to a thread
 */
export interface AddThreadTopicInput {
  displayName?: string | null;
  threadMutationId: string;
  topicId?: string | null;
}

/**
 * The input required to add a user delegate.
 */
export interface AddUserDelegateInput {
  delegateRole: DelegateRole;
  delegateUserId: string;
  onBehalfOfUserId: string;
}

/**
 * The additional input required to edit a praise in a message.
 */
export interface EditMessagePraiseInput {
  badge: PraiseBadge;
  userIds: string[];
}

/**
 * A set of telemetry context values for a feed type and id used as input when marking threads and messages as seen
 */
export interface FeedThreadTelemetryContextInput {
  subtype: TelemetryFeedSubtype;
  telemetryId?: string | null;
  type: TelemetryFeedType;
}

/**
 * The input required to mark a group message as seen
 */
export interface MarkMessageOfThreadAsSeenInput {
  messageMutationId: string;
  threadMutationId: string;
}

/**
 * The input required to mark a thread as seen
 */
export interface MarkThreadAsSeenInput {
  latestMessageId?: string | null;
  threadMarkSeenKey: string;
}

/**
 * The input required to unmark a group as favorite for a user
 */
export interface RemoveFavoriteGroupInput {
  groupId: string;
}

/**
 * The input required to remove a participnat from a thread.
 */
export interface RemoveParticipantsInput {
  participantIds: string[];
  threadMutationId: string;
}

/**
 * The input required to remove a topic from a thread
 */
export interface RemoveThreadTopicInput {
  threadMutationId: string;
  topicId: string;
}

/**
 * The input required to remove a user delegate.
 */
export interface RemoveUserDelegateInput {
  delegateUserId: string;
  onBehalfOfUserId: string;
}

/**
 * The input required to update app activity state.
 */
export interface UpdateAppActivityStateInput {
  appActivityState: AppActivityState;
}

/**
 * The input required to update broadcast activity state.
 */
export interface UpdateBroadcastActivityStateInput {
  broadcastActivityState: BroadcastActivityState;
  broadcastId: string;
}

//==============================================================
// END Enums and Input Objects
//==============================================================
